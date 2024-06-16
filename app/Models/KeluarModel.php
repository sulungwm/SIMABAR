<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluarModel extends Model
{
    protected $table            = 'tb_barangkeluar';
    protected $primaryKey       = 'id_barangkeluar';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_produk', 'jumlah_barang', 'tanggal_keluar'];

    public function getAll()
    {
        return $this->select('tb_barangkeluar.*, tb_produk.nama_produk')
            ->join('tb_produk', 'tb_produk.id_produk = tb_barangkeluar.id_produk')
            ->orderBy('tanggal_keluar', 'DESC') 
            ->findAll();
    }
}
