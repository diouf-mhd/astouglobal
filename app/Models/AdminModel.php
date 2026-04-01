<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'awa_fall'; // nom de ta table
    protected $primaryKey = 'numero';

    protected $allowedFields = ['numero', 'mot_de_pass'];
}