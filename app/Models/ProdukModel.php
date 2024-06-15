<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'tb_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'id_kategori', 'id_jenis', 'stock', 'nama_produk', 'deskripsi', 'harga'];

    public function getAll()
    {
        return $this->select('tb_produk.*, tb_user.email, tb_jenis_barang.nama_jenis, tb_kategori_barang.nama_kategori')
            ->join('tb_user', 'tb_user.id_user = tb_produk.id_user')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori = tb_produk.id_kategori')
            ->join('tb_jenis_barang', 'tb_jenis_barang.id_jenis = tb_produk.id_jenis')
            ->findAll();
    }

    public function getById($id)
    {
        return $this->select('tb_produk.*, tb_user.email, tb_jenis_barang.nama_jenis, tb_kategori_barang.nama_kategori')
            ->join('tb_user', 'tb_user.id_user = tb_produk.id_user')
            ->join('tb_kategori_barang', 'tb_kategori_barang.id_kategori = tb_produk.id_kategori')
            ->join('tb_jenis_barang', 'tb_jenis_barang.id_jenis = tb_produk.id_jenis')
            ->where('tb_produk.id_produk', $id)
            ->first();
    }
}
