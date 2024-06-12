<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailProdukModel extends Model
{
    protected $table            = 'tb_detail_produk';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_produk','nama_file'];

}
