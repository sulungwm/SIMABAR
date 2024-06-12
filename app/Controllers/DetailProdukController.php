<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProdukModel;
use App\Models\DetailProdukModel;
class DetailProdukController extends BaseController
{
    protected $ProdukModel;
    protected $DetailProduk;
    public function __construct()
    {
        $this->ProdukModel = new ProdukModel();
        $this->DetailProduk = new DetailProdukModel();
    }

    public function show($id)
    {
        $data['produk'] = $this->ProdukModel->getById($id);
        return view('detailproduk/index', $data);
    }

    // public function create()
    // {
    //     $kategori = $this->KategoriModel->findAll();
    //     $jenis = $this->JenisModel->findAll();
    //     $data = [
    //         'kategori' => $kategori,
    //         'jenis' => $jenis,
    //     ];

    //     return view('produk/create', $data);
    // }


    // public function add()
    // {
    //     $data = [
    //         'id_user' => session()->get('id_user'),
    //         'id_kategori' => $this->request->getPost('id_kategori'),
    //         'id_jenis' => $this->request->getPost('id_jenis'),
    //         'stock' => $this->request->getPost('stock'),
    //         'nama_produk' => $this->request->getPost('nama_produk'),
    //         'deskripsi' => $this->request->getPost('deskripsi'),
    //         'harga' => $this->request->getPost('harga')
    //     ];

    //     $this->ProdukModel->insert($data);
    //     return redirect()->to('/produk');
    // }

    // public function edit($id)
    // {
    //     $produk = $this->ProdukModel->find($id);
    //     $kategori = $this->KategoriModel->findAll();
    //     $jenis = $this->JenisModel->findAll();
    //     $data = [
    //         'produk' => $produk,
    //         'kategori' => $kategori,
    //         'jenis' => $jenis,
    //     ];

    //     return view('produk/edit', $data);
    // }

    // public function update($id)
    // {
    //     $data = [
    //         'id_user' => session()->get('id_user'),
    //         'id_kategori' => $this->request->getPost('id_kategori'),
    //         'id_jenis' => $this->request->getPost('id_jenis'),
    //         'stock' => $this->request->getPost('stock'),
    //         'nama_produk' => $this->request->getPost('nama_produk'),
    //         'deskripsi' => $this->request->getPost('deskripsi'),
    //         'harga' => $this->request->getPost('harga')
    //     ];

    //     $this->ProdukModel->update($id, $data);
    //     return redirect()->to('/produk');
    // }

    // public function delete($id)
    // {
    //     $this->ProdukModel->delete($id);
    //     return redirect()->to('/produk');
    // }
}
