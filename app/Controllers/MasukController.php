<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasukModel;
use App\Models\ProdukModel;



class MasukController extends BaseController
{
    protected $MasukModel;
    protected $ProdukModel;

    public function __construct()
    {
        $this->MasukModel = new MasukModel();
        $this->ProdukModel = new ProdukModel();
    }

    public function index()
    {
        $data['masuk'] = $this->MasukModel->getAll();
        return view('masuk/index', $data);
    }

    public function create()
    {
        $produk = $this->ProdukModel->findAll();
        $data = [
            'produk' => $produk,
        ];

        return view('masuk/create', $data);
    }

    public function add()
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_masuk = $this->request->getPost('tanggal_masuk');

        // cari produk berdasarkan id_produk kemudian tambahkan total stock dengan jumlah_barang
        $produk = $this->ProdukModel->find($id_produk);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] + $jumlah_barang;
        }
        // perbarui total stock produk dari hasil penjumlahan
        $dataProduk['stock'] = $jumlah_baru;
        $this->ProdukModel->update($id_produk, $dataProduk);

        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_masuk' => $tanggal_masuk
        ];

        $this->MasukModel->insert($data);
        return redirect()->to('/masuk');
    }

    public function delete($id)
    {
        $barang_masuk = $this->MasukModel->find($id);
        // cari produk berdasarkan id_produk kemudian kembalikan total stok semula
        $produk = $this->ProdukModel->find($barang_masuk['id_produk']);
        if (!empty($produk)) {
            $jumlah_baru = $produk['stock'] - $barang_masuk['jumlah_barang'];
            // perbarui total stock produk dari hasil penjumlahan
            $dataProduk['stock'] = $jumlah_baru;
            $this->ProdukModel->update($barang_masuk['id_produk'], $dataProduk);
        }

        $this->MasukModel->delete($id);
        return redirect()->to('/masuk');
    }

    public function edit($id)
    {
        $barangmasuk = $this->MasukModel->find($id);
        $produk = $this->ProdukModel->findAll();

        $data = [
            'barangmasuk' =>  $barangmasuk,
            'produk' => $produk,
        ];

        return view('masuk/edit', $data);
    }

    public function update($id)
    {
        $id_produk = $this->request->getPost('id_produk');
        $jumlah_barang = $this->request->getPost('jumlah_barang');
        $tanggal_masuk = $this->request->getPost('tanggal_masuk');

        // cari produk dan kembalikan jumlah stok semula
        $masuk_old = $this->MasukModel->find($id);
        $produk_old = $this->ProdukModel->find($masuk_old['id_produk']);

        if (!empty($produk_old)) {
            $jumlah_old = $produk_old['stock'] - $masuk_old['jumlah_barang'];
            $produk_old['stock'] = $jumlah_old;
            $this->ProdukModel->update($masuk_old['id_produk'], $produk_old);
        }


        // cari ulang produk berdasarkan inputan $id_produk dan tambahkan stocknya dari inputan jumlah_barang
        // Hal ini akan lebih efektif ketika user mengubah produk yang dipilih ketika mengedit data barang masuk
        $produk_new = $this->ProdukModel->find($id_produk);
        if (!empty($produk_new)) {
            $jumlah_new = $produk_new['stock'] + $jumlah_barang;
            $produk_new['stock'] = $jumlah_new;
            $this->ProdukModel->update($id_produk, $produk_new);
        }


        // perbarui data barangmasuk yang diedit
        $data = [
            'id_produk' =>  $id_produk,
            'jumlah_barang' => $jumlah_barang,
            'tanggal_masuk' => $tanggal_masuk
        ];
        $this->MasukModel->update($id, $data);


        return redirect()->to('/masuk');
    }
}
