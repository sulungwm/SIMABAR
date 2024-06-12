<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisModel extends Model
{
    protected $table            = 'tb_jenis_barang';
    protected $primaryKey       = 'id_jenis';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_jenis'];

   
}
