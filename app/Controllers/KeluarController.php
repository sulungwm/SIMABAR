<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KeluarModel;
use App\Models\ProdukModel;

class KeluarController extends BaseController
{

    protected $KeluarModel;
    protected $ProdukModel;

    public function __construct()
    {
        $this->KeluarModel = new KeluarModel();
        $this->ProdukModel = new ProdukModel();
    }

    public function index()
    {
        $data['keluar'] = $this->KeluarModel->getAll();
        return view('keluar/index', $data);
    }

    public function create()
    {
        $produk = $this->ProdukModel->findAll();
        $data = [
            'produk' => $produk,
        ];

        return view('keluar/create', $data);
    }

    public function add()
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_keluar = $this->request->getPost('tanggal_keluar');

        // cari produk berdasarkan id_produk kemudian kurangkan total stock dengan jumlah_barang keluar
        $produk = $this->ProdukModel->find($id_produk);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] - $jumlah_barang;
            // perbarui total stock produk dari hasil penjumlahan
            $dataProduk['stock'] = $jumlah_baru;
            $this->ProdukModel->update($id_produk, $dataProduk);
        }

        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_keluar' => $tanggal_keluar
        ];

        $this->KeluarModel->insert($data);
        return redirect()->to('/keluar');
    }

    public function delete($id)
    {
        $barang_keluar = $this->KeluarModel->find($id);
        //cari produk berdasarkan id_produk kemudian kembalikan total stok semula
        $produk = $this->ProdukModel->find($barang_keluar['id_produk']);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] + $barang_keluar['jumlah_barang'];
            // perbarui total stock produk dari hasil penjumlahan
            $dataProduk['stock'] = $jumlah_baru;
            $this->ProdukModel->update($barang_keluar['id_produk'], $dataProduk);
        }
        
        $this->KeluarModel->delete($id);
        return redirect()->to('/keluar');
    }


    public function edit($id)
    {
        $barangkeluar = $this->KeluarModel->find($id);
        $produk = $this->ProdukModel->findAll();
        $stok_produk = null;

        if ($barangkeluar && isset($barangkeluar['id_produk'])) {
            $produk_selected = $this->ProdukModel->find($barangkeluar['id_produk']);
            $stok_produk = $produk_selected ? $produk_selected['stock'] : null;
        }

        $data = [
            'barangkeluar' => $barangkeluar,
            'produk' => $produk,
            'stok_produk' => $stok_produk
        ];

        return view('keluar/edit', $data);
    }

    public function update($id)
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_keluar = $this->request->getPost('tanggal_keluar');

        // cari produk dan kembalikan jumlah stok semula
        $keluar_old = $this->KeluarModel->find($id);
        $produk_old = $this->ProdukModel->find($keluar_old['id_produk']);

        if (!empty($produk_old)) {
            $jumlah_old = $produk_old['stock'] + $keluar_old['jumlah_barang'];
            $produk_old['stock'] = $jumlah_old;
            $this->ProdukModel->update($keluar_old['id_produk'], $produk_old);
        }


        // cari ulang produk berdasarkan inputan $id_produk dan kurangkan stocknya dari inputan jumlah_barang keluar
        // Hal ini akan lebih efektif ketika user mengubah produk yang dipilih ketika mengedit data barang keluar
        $produk_new = $this->ProdukModel->find($id_produk);
        if (!empty($produk_new)) {
            $jumlah_new = $produk_new['stock'] - $jumlah_barang;
            $produk_new['stock'] = $jumlah_new;
            $this->ProdukModel->update($id_produk, $produk_new);
        }


        // perbarui data barangkeluar yang diedit
        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_keluar' => $tanggal_keluar
        ];
        $this->KeluarModel->update($id, $data);


        return redirect()->to('/keluar');
    }
}
