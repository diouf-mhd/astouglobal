<?php

namespace App\Controllers;

use App\Libraries\ProductCatalog;
use App\Traits\ApiResponse;

class Admin extends BaseController
{
    use ApiResponse;
    
    private ProductCatalog $catalog;

    /**
     * Tables autorisees pour l'authentification admin.
     *
     * @var list<string>
     */
    private array $adminTables = ['awa_fall'];

    public function __construct()
    {
        $this->catalog = new ProductCatalog();
    }

public function login()
{
    helper(['form', 'url']);
    $session = session();

    if (strtolower($this->request->getMethod()) !== 'post') {
        return view('V_admin', [
            'phoneValue' => old('phone'),
        ]);
    }

    $rules = [
        'phone'    => 'required|min_length[9]|max_length[20]',
        'password' => 'required|min_length[6]',
    ];

    if (! $this->validate($rules)) {
        return redirect()->to(base_url('admin'))
            ->with('validation', $this->validator)
            ->with('error', 'Formulaire invalide. Verifiez le numero et le mot de passe.')
            ->with('phoneValue', (string) $this->request->getPost('phone'))
            ->withInput();
    }

    $phoneInput = (string) $this->request->getPost('phone');
    $phone = $this->normalizePhone($phoneInput);

    $password = (string) $this->request->getPost('password');
    $admin = $this->findAdminByPhone($phone);

    if (! $admin) {
        return redirect()->to(base_url('admin'))
            ->with('error', 'Numero incorrect. Verifiez votre identifiant.')
            ->with('loginErrorDetails', [
                'Le numero saisi ne correspond a aucun compte admin.',
                'Sous XAMPP, verifiez aussi que l URL utilisee est bien celle du projet local.',
            ])
            ->with('phoneValue', $phoneInput)
            ->withInput();
    }

    $storedPassword = trim((string) ($admin['mot_de_pass'] ?? ''));

    if (! $this->passwordMatches($password, $storedPassword)) {
        return redirect()->to(base_url('admin'))
            ->with('error', 'Mot de passe incorrect. Reessayez.')
            ->with('loginErrorDetails', [
                'Le mot de passe ne correspond pas au compte admin trouve.',
            ])
            ->with('phoneValue', $phoneInput)
            ->withInput();
    }

    $session->set([
        'admin_id'   => $admin['numero'],
        'isLoggedIn' => true,
    ]);

    return redirect()->to(base_url('/'))
        ->with('success', 'Connexion reussie. Vous etes connecte en tant qu administrateur.')
        ->with('phoneValue', $phoneInput);
}

public function logout()
{
    session()->remove(['admin_id', 'isLoggedIn']);
    session()->regenerate(true);

    return redirect()->to(base_url('admin'));
}

    public function addProduct()
    {
        if (session('isLoggedIn') !== true) {
            return redirect()->to(base_url('admin'))->with('error', 'Connectez-vous comme admin.');
        }

        $rules = [
            'category' => 'required|in_list[vetements,homme,chaussures,jalabe,parfum]',
            'name'     => 'required|min_length[2]',
            'price'    => 'required|min_length[2]',
            'image_file' => 'uploaded[image_file]|is_image[image_file]|mime_in[image_file,image/jpg,image/jpeg,image/png,image/webp]|max_size[image_file,5120]',
            'alt'      => 'permit_empty|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            $category = (string) $this->request->getPost('category');

            return redirect()->to('/' . $category)
                ->with('validation', $this->validator)
                ->with('old_input', $this->request->getPost());
        }

        $category = (string) $this->request->getPost('category');
        $name = trim((string) $this->request->getPost('name'));
        $price = trim((string) $this->request->getPost('price'));
        $alt = trim((string) $this->request->getPost('alt')) ?: $name;
        $imageFile = $this->request->getFile('image_file');

        if ($imageFile === null || ! $imageFile->isValid()) {
            return redirect()->to('/' . $category)
                ->with('error', 'Image introuvable. Selectionnez une photo puis reessayez.')
                ->with('old_input', $this->request->getPost());
        }

        $uploadDirectory = FCPATH . 'uploads/products/' . $category;

        if (! is_dir($uploadDirectory) && ! mkdir($uploadDirectory, 0777, true) && ! is_dir($uploadDirectory)) {
            return redirect()->to('/' . $category)
                ->with('error', 'Impossible de preparer le dossier des images.')
                ->with('old_input', $this->request->getPost());
        }

        $imageName = $imageFile->getRandomName();
        $imageFile->move($uploadDirectory, $imageName);
        $image = 'uploads/products/' . $category . '/' . $imageName;

        $this->catalog->add($category, [
            'id'    => $category . '-' . bin2hex(random_bytes(4)),
            'image' => $image,
            'alt'   => $alt,
            'name'  => $name,
            'price' => $price,
        ]);

        return redirect()->to('/' . $category)->with('success', 'Produit ajoute sur la liste.');
    }

    public function deleteProduct(string $category, string $id)
    {
        if (session('isLoggedIn') !== true) {
            return redirect()->to('/admin')->with('error', 'Connectez-vous comme admin.');
        }

        if (! in_array($category, ['vetements', 'homme', 'chaussures', 'jalabe', 'parfum'], true)) {
            return redirect()->to('/')->with('error', 'Categorie invalide.');
        }

        $product = $this->catalog->find($category, $id);
        $this->catalog->delete($category, $id);

        if ($product !== null) {
            $image = (string) ($product['image'] ?? '');

            if (str_starts_with($image, 'uploads/products/')) {
                $imagePath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $image);

                if (is_file($imagePath)) {
                    @unlink($imagePath);
                }
            }
        }

        return redirect()->to('/' . $category)->with('success', 'Produit supprime de la liste.');
    }

private function findAdminByPhone(string $phone): ?array
{
    $db = db_connect();
    $candidates = array_values(array_unique([
        $phone,
        '221' . $phone,
        '+' . '221' . $phone,
    ]));

    foreach ($this->adminTables as $table) {
        $admin = $db->table($table)
            ->whereIn('numero', $candidates)
            ->get()
            ->getRowArray();

        if ($admin !== null) {
            $admin['source_table'] = $table;
            return $admin;
        }
    }

    return null;
}

private function normalizePhone(string $phoneInput): string
{
    $phone = preg_replace('/\D+/', '', $phoneInput) ?? '';

    if (substr($phone, 0, 3) === '221') {
        return substr($phone, 3);
    }

    return $phone;
}

private function passwordMatches(string $password, string $storedPassword): bool
{
    if ($storedPassword === '') {
        return false;
    }

    if (password_verify($password, $storedPassword)) {
        return true;
    }

    return hash_equals($storedPassword, $password);
}

private function updateAdminPassword(string $table, string $phone, string $password): void
{
    db_connect()
        ->table($table)
        ->where('numero', $phone)
        ->set('mot_de_pass', password_hash($password, PASSWORD_DEFAULT))
        ->update();
}

// API Methods
public function apiLogin()
{
    if ($this->request->getMethod() !== 'post') {
        return $this->respondError('Method not allowed', 405);
    }

    $input = $this->request->getJSON();
    $username = $input->username ?? null;
    $password = $input->password ?? null;

    if (!$username || !$password) {
        return $this->respondValidationError([
            'username' => 'Username is required',
            'password' => 'Password is required',
        ]);
    }

    // Treat username as phone
    $phone = $this->normalizePhone($username);
    $admin = $this->findAdminByPhone($phone);

    if (!$admin) {
        return $this->respondError('Invalid credentials', 401);
    }

    $storedPassword = trim($admin['mot_de_pass'] ?? '');

    if (!$this->passwordMatches($password, $storedPassword)) {
        return $this->respondError('Invalid credentials', 401);
    }

    // Generate a simple token (in production, use JWT)
    $token = bin2hex(random_bytes(32));
    session()->set([
        'admin_id'   => $admin['numero'],
        'isLoggedIn' => true,
        'api_token'  => $token,
    ]);

    return $this->respondSuccess([
        'token' => $token,
        'admin_id' => $admin['numero'],
    ], 'Login successful', 200);
}

public function apiLogout()
{
    session()->remove(['admin_id', 'isLoggedIn', 'api_token']);
    session()->regenerate(true);

    return $this->respondSuccess(null, 'Logout successful', 200);
}

public function apiAddProduct()
{
    if (!session('isLoggedIn')) {
        return $this->respondUnauthorized();
    }

    if ($this->request->getMethod() !== 'post') {
        return $this->respondError('Method not allowed', 405);
    }

    $input = $this->request->getJSON();
    $category = $input->category ?? null;
    $name = $input->name ?? null;
    $price = $input->price ?? null;
    $description = $input->description ?? null;

    if (!$category || !$name || !$price) {
        return $this->respondValidationError([
            'category' => 'Category is required',
            'name' => 'Name is required',
            'price' => 'Price is required',
        ]);
    }

    $validCategories = ['vetements', 'homme', 'chaussures', 'jalabe', 'parfum'];
    if (!in_array($category, $validCategories)) {
        return $this->respondError('Invalid category', 422);
    }

    // Handle file upload if present
    $image = null;
    $imageFile = $this->request->getFile('image');
    
    if ($imageFile && $imageFile->isValid()) {
        $uploadDirectory = FCPATH . 'uploads/products/' . $category;
        
        if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0777, true) && !is_dir($uploadDirectory)) {
            return $this->respondError('Failed to create upload directory', 500);
        }

        $imageName = $imageFile->getRandomName();
        $imageFile->move($uploadDirectory, $imageName);
        $image = 'uploads/products/' . $category . '/' . $imageName;
    }

    $this->catalog->add($category, [
        'id'    => $category . '-' . bin2hex(random_bytes(4)),
        'image' => $image,
        'alt'   => $name,
        'name'  => $name,
        'price' => $price,
        'description' => $description,
    ]);

    return $this->respondSuccess(null, 'Product added successfully', 201);
}

public function apiDeleteProduct(string $category, string $id)
{
    if (!session('isLoggedIn')) {
        return $this->respondUnauthorized();
    }

    if ($this->request->getMethod() !== 'delete') {
        return $this->respondError('Method not allowed', 405);
    }

    $validCategories = ['vetements', 'homme', 'chaussures', 'jalabe', 'parfum'];
    if (!in_array($category, $validCategories)) {
        return $this->respondError('Invalid category', 422);
    }

    $product = $this->catalog->find($category, $id);
    
    if (!$product) {
        return $this->respondNotFound('Product not found');
    }

    $this->catalog->delete($category, $id);

    if ($product !== null) {
        $image = $product['image'] ?? '';
        if (str_starts_with($image, 'uploads/products/')) {
            $imagePath = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $image);
            if (is_file($imagePath)) {
                @unlink($imagePath);
            }
        }
    }

    return $this->respondSuccess(null, 'Product deleted successfully', 200);
}
}
