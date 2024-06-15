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
        $data = [
            'id_produk' => $this->request->getPost('id_produk'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk')
        ];

        $this->MasukModel->insert($data);
        return redirect()->to('/masuk');
    }

    public function delete($id)
    {
        $this->ProdukModel->delete($id);
        return redirect()->to('/masuk');
    }
}
