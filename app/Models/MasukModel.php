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

    public function getDataCetak($tgl_awal, $tgl_akhir)
    {
        return $this->select('tb_barangmasuk.*, tb_produk.nama_produk')
            ->join('tb_produk', 'tb_produk.id_produk = tb_barangmasuk.id_produk')
            ->where('tanggal_masuk >=', $tgl_awal)
            ->where('tanggal_masuk <=', $tgl_akhir)
            ->findAll();
    }

    public function getTotal($id_produk, $tgl_awal, $tgl_akhir)
    {
        return $this->selectSum('jumlah_barang')
        ->where('id_produk', $id_produk)
            ->where('tanggal_masuk >=', $tgl_awal)
            ->where('tanggal_masuk <=', $tgl_akhir)
            ->first()['jumlah_barang'] ?? 0;
    }

    public function getCount()
    {
        return $this->select('tb_barangmasuk.*, tb_produk.nama_produk')
        ->join('tb_produk', 'tb_produk.id_produk = tb_barangmasuk.id_produk')
        ->countAllResults();
    }
}
