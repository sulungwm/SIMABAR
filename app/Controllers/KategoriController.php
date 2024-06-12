<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;
class KategoriController extends BaseController
{
    protected $KategoriModel;
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->KategoriModel->findAll();
        return view('kategori/index', $data);
    }

    public function create()
    {
        return view('kategori/create');
    }


    public function add()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];

        $this->KategoriModel->insert($data);
        return redirect()->to('/kategori');
    }

    public function edit($id)
    {
        $kategori = $this->KategoriModel->find($id);

        $data = [
            'kategori' => $kategori,
        ];

        return view('kategori/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        ];
        $this->KategoriModel->update($id,$data);
        return redirect()->to('/kategori');
    }

    public function delete($id)
    {
        $this->KategoriModel->delete($id);
        return redirect()->to('/kategori');
    }
}
