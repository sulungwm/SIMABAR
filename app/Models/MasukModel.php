<?php

namespace App\Models;

use CodeIgniter\Model;

class MasukModel extends Model
{
    protected $table            = 'tb_barangmasuk';
    protected $primaryKey       = 'id_barangmasuk';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_produk', 'jumlah_barang', 'tanggal_masuk'];

    public function getAll()
    {
        return $this->select('tb_barangmasuk.*, tb_produk.nama_produk')
            ->join('tb_produk', 'tb_produk.id_produk = tb_barangmasuk.id_produk')
            ->orderBy('tanggal_masuk', 'DESC') 
            ->findAll();
    }
}
