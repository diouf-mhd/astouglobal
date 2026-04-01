<?php

namespace App\Libraries;

class ProductCatalog
{
    private string $storagePath;

    private array $defaultCatalog = [
        'vetements' => [
            ['id' => 'vetements-1', 'image' => 'assets/img/HF10.jpeg', 'alt' => 'Robe', 'name' => 'Robe', 'price' => '8 000 FCFA'],
            ['id' => 'vetements-2', 'image' => 'assets/img/HF2.jpeg', 'alt' => 'Ensemble chemise et pantalon', 'name' => 'Ensemble chemise et pantalon', 'price' => '6 000 FCFA'],
            ['id' => 'vetements-3', 'image' => 'assets/img/HF3.jpeg', 'alt' => 'Ensemble robe et manteau', 'name' => 'Ensemble robe et manteau', 'price' => '6 000 FCFA'],
            ['id' => 'vetements-4', 'image' => 'assets/img/HF14.jpeg', 'alt' => 'Robe', 'name' => 'Robe et manteau', 'price' => '7 000 FCFA'],
            ['id' => 'vetements-5', 'image' => 'assets/img/HF6.jpeg', 'alt' => 'Ensemble', 'name' => 'Ensemble', 'price' => '6 500 FCFA'],
            ['id' => 'vetements-6', 'image' => 'assets/img/HF7.jpeg', 'alt' => 'Robe', 'name' => 'Robe', 'price' => '6 500 FCFA'],
            ['id' => 'vetements-7', 'image' => 'assets/img/HF8.jpeg', 'alt' => 'Ensemble', 'name' => 'Ensemble', 'price' => '8 000 FCFA'],
            ['id' => 'vetements-8', 'image' => 'assets/img/HF9.jpeg', 'alt' => 'Robe avec foulard', 'name' => 'Robe avec foulard', 'price' => '6 000 FCFA'],
            ['id' => 'vetements-9', 'image' => 'assets/img/HF16.jpeg', 'alt' => 'Ensemble', 'name' => 'Ensemble', 'price' => '7 000 FCFA'],
        ],
        'homme' => [
            ['id' => 'homme-1', 'image' => 'assets/img/HH1.jpeg', 'alt' => 'Tenue homme modele 1', 'name' => 'Tenue homme modele 1', 'price' => '6 000 FCFA'],
            ['id' => 'homme-2', 'image' => 'assets/img/HH2.jpeg', 'alt' => 'Tenue homme modele 2', 'name' => 'Tenue homme modele 2', 'price' => '9 000 FCFA'],
            ['id' => 'homme-3', 'image' => 'assets/img/HH0.jpeg', 'alt' => 'Tenue homme modele 3', 'name' => 'Tenue homme modele 3', 'price' => '9 000 FCFA'],
            ['id' => 'homme-4', 'image' => 'assets/img/H11.jpeg', 'alt' => 'Tenue homme modele 4', 'name' => 'Tenue homme modele 4', 'price' => '3 000 FCFA'],
            ['id' => 'homme-5', 'image' => 'assets/img/HH5.jpeg', 'alt' => 'Tenue homme modele 5', 'name' => 'Tenue homme modele 5', 'price' => '4 000 FCFA'],
            ['id' => 'homme-6', 'image' => 'assets/img/HH6.jpeg', 'alt' => 'Tenue homme modele 6', 'name' => 'Tenue homme modele 6', 'price' => '3 000 FCFA'],
            ['id' => 'homme-7', 'image' => 'assets/img/HH7.jpeg', 'alt' => 'Tenue homme modele 7', 'name' => 'Tenue homme modele 7', 'price' => '3 000 FCFA'],
            ['id' => 'homme-8', 'image' => 'assets/img/HH8.jpeg', 'alt' => 'Tenue homme modele 8', 'name' => 'Tenue homme modele 8', 'price' => '6 500 FCFA'],
            ['id' => 'homme-9', 'image' => 'assets/img/HH9.jpeg', 'alt' => 'Tenue homme modele 9', 'name' => 'Tenue homme modele 9', 'price' => '9 000 FCFA'],
            ['id' => 'homme-10', 'image' => 'assets/img/HH10.jpeg', 'alt' => 'Tenue homme modele 10', 'name' => 'Tenue homme modele 10', 'price' => '6 500 FCFA'],
            ['id' => 'homme-11', 'image' => 'assets/img/HH3.jpeg', 'alt' => 'Tenue homme modele 11', 'name' => 'Tenue homme modele 11', 'price' => '6 500 FCFA'],
        ],
        'chaussures' => [
            ['id' => 'chaussures-1', 'image' => 'assets/img/C1.jpeg', 'alt' => 'Chaussures femme', 'name' => 'Chaussures femme', 'price' => '2 500 FCFA'],
            ['id' => 'chaussures-2', 'image' => 'assets/img/C2.jpeg', 'alt' => 'Modele pieds nus', 'name' => 'Modele pieds nus', 'price' => '15 000 FCFA'],
            ['id' => 'chaussures-3', 'image' => 'assets/img/C3.jpeg', 'alt' => 'Chaussures classiques', 'name' => 'Chaussures classiques', 'price' => '20 000 FCFA'],
        ],
        'jalabe' => [
            ['id' => 'jalabe-1', 'image' => 'assets/img/jalabe2.jpg', 'alt' => 'Jalabe modele 1', 'name' => 'Ensemble chemise et robe', 'price' => '9 000 FCFA'],
            ['id' => 'jalabe-2', 'image' => 'assets/img/HF4.jpeg', 'alt' => 'Jalabe modele 2', 'name' => 'Jalabe', 'price' => '12 000 FCFA'],
            ['id' => 'jalabe-3', 'image' => 'assets/img/dialabe.jpg', 'alt' => 'Jalabe modele 3', 'name' => 'Jalabe', 'price' => '6 000 FCFA'],
            ['id' => 'jalabe-4', 'image' => 'assets/img/JB19.jpeg', 'alt' => 'Jalabe modele 4', 'name' => 'Jalabe modele 4', 'price' => '11 000 FCFA'],
            ['id' => 'jalabe-5', 'image' => 'assets/img/JB2.jpeg', 'alt' => 'Jalabe modele 5', 'name' => 'Jalabe modele 5', 'price' => '11 000 FCFA'],
            ['id' => 'jalabe-6', 'image' => 'assets/img/JB4.jpeg', 'alt' => 'Jalabe modele 6', 'name' => 'Jalabe modele 6', 'price' => '11 000 FCFA'],
            ['id' => 'jalabe-7', 'image' => 'assets/img/JB3.jpeg', 'alt' => 'Jalabe modele 7', 'name' => 'Jalabe modele 7', 'price' => '11 000 FCFA'],
            ['id' => 'jalabe-8', 'image' => 'assets/img/JB5.jpeg', 'alt' => 'Jalabe modele 8', 'name' => 'Jalabe modele 8', 'price' => '11 000 FCFA'],
            ['id' => 'jalabe-9', 'image' => 'assets/img/JB11.jpeg', 'alt' => 'Jalabe modele 9', 'name' => 'Jalabe modele 9', 'price' => '11 000 FCFA'],
        ],
        'parfum' => [
            ['id' => 'parfum-1', 'image' => 'assets/img/P1.jpeg', 'alt' => 'Liquid Brun', 'name' => 'Liquid Brun', 'price' => '8 000 FCFA'],
            ['id' => 'parfum-2', 'image' => 'assets/img/P2.jpeg', 'alt' => 'Jean Lowe noir', 'name' => 'Jean Lowe noir', 'price' => '8 000 FCFA'],
            ['id' => 'parfum-3', 'image' => 'assets/img/blue_chanel.jpg', 'alt' => 'Blue Chanel', 'name' => 'Blue Chanel', 'price' => '6 000 FCFA'],
            ['id' => 'parfum-4', 'image' => 'assets/img/P3.jpeg', 'alt' => 'Khair Confection', 'name' => 'Khair Confection', 'price' => '7 000 FCFA'],
            ['id' => 'parfum-5', 'image' => 'assets/img/P4.jpeg', 'alt' => 'Khair Confection', 'name' => 'Khair Confection', 'price' => '7 000 FCFA'],
            ['id' => 'parfum-6', 'image' => 'assets/img/P5.jpeg', 'alt' => 'Mousuf', 'name' => 'Mousuf', 'price' => '7 000 FCFA'],
            ['id' => 'parfum-7', 'image' => 'assets/img/P6.jpeg', 'alt' => 'Mousuf', 'name' => 'Mousuf', 'price' => '8 000 FCFA'],
            ['id' => 'parfum-8', 'image' => 'assets/img/P7.jpeg', 'alt' => 'Yara', 'name' => 'Yara', 'price' => '8 000 FCFA'],
            ['id' => 'parfum-9', 'image' => 'assets/img/P8.jpeg', 'alt' => 'Axe Dark', 'name' => 'Axe Dark', 'price' => '6 000 FCFA'],
        ],
    ];

    public function __construct()
    {
        $basePath = defined('WRITEPATH')
            ? WRITEPATH
            : dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'writable' . DIRECTORY_SEPARATOR;

        $this->storagePath = $basePath . 'product-catalog.json';
    }

    public function category(string $category): array
    {
        $catalog = $this->all();

        return $catalog[$category] ?? [];
    }

    public function add(string $category, array $product): void
    {
        $catalog = $this->all();
        $catalog[$category] ??= [];
        $catalog[$category][] = $product;
        $this->persist($catalog);
    }

    public function find(string $category, string $id): ?array
    {
        $catalog = $this->all();

        if (! isset($catalog[$category]) || ! is_array($catalog[$category])) {
            return null;
        }

        foreach ($catalog[$category] as $product) {
            if (($product['id'] ?? '') === $id) {
                return $product;
            }
        }

        return null;
    }

    public function delete(string $category, string $id): void
    {
        $catalog = $this->all();

        if (! isset($catalog[$category])) {
            return;
        }

        $catalog[$category] = array_values(array_filter(
            $catalog[$category],
            static fn (array $product): bool => ($product['id'] ?? '') !== $id
        ));

        $this->persist($catalog);
    }

    private function all(): array
    {
        if (! is_file($this->storagePath)) {
            $this->persist($this->defaultCatalog);
        }

        $catalog = json_decode((string) file_get_contents($this->storagePath), true);

        if (! is_array($catalog)) {
            $catalog = $this->defaultCatalog;
            $this->persist($catalog);
        }

        foreach ($this->defaultCatalog as $category => $defaults) {
            if (! isset($catalog[$category]) || ! is_array($catalog[$category])) {
                $catalog[$category] = $defaults;
            }
        }

        return $catalog;
    }

    private function persist(array $catalog): void
    {
        file_put_contents(
            $this->storagePath,
            json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        );
    }
}
