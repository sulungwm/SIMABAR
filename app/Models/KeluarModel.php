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

    public function getDataCetak($tgl_awal, $tgl_akhir)
    {
        return $this->select('tb_barangkeluar.*, tb_produk.nama_produk')
        ->join('tb_produk', 'tb_produk.id_produk = tb_barangkeluar.id_produk')
        ->where('tanggal_keluar >=', $tgl_awal)
            ->where('tanggal_keluar <=', $tgl_akhir)
            ->findAll();
    }

    public function getTotal($id_produk, $tgl_awal, $tgl_akhir)
    {
        return $this->selectSum('jumlah_barang')
        ->where('id_produk', $id_produk)
            ->where('tanggal_keluar >=', $tgl_awal)
            ->where('tanggal_keluar <=', $tgl_akhir)
            ->first()['jumlah_barang'] ?? 0;
    }

    public function getCount()
    {
        return $this->select('tb_barangkeluar.*, tb_produk.nama_produk')
        ->join('tb_produk', 'tb_produk.id_produk = tb_barangkeluar.id_produk')
        ->countAllResults();
    }
}
