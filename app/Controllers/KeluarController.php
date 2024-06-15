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
        $data = [
            'id_produk' => $this->request->getPost('id_produk'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang'),
            'tanggal_keluar' => $this->request->getPost('tanggal_keluar')
        ];

        $this->MasukModel->insert($data);
        return redirect()->to('/keluar');
    }

    public function delete($id)
    {
        $this->ProdukModel->delete($id);
        return redirect()->to('/keluar');
    }
}
