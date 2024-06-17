<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JenisModel;

class JenisController extends BaseController
{
    protected $JenisModel;
    public function __construct()
    {
        $this->JenisModel = new JenisModel();
    }

    public function index()
    {
        $data['jenis'] = $this->JenisModel->findAll();
        return view('jenis/index', $data);
    }

    public function create()
    {
        return view('jenis/create');
    }


    public function add()
    {
        $data = [
            'nama_jenis' => $this->request->getPost('nama_jenis'),
        ];

        $this->JenisModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/jenis');
    }

    public function edit($id)
    {
        $jenis = $this->JenisModel->find($id);

        $data = [
            'jenis' => $jenis,
        ];

        return view('jenis/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_jenis' => $this->request->getPost('nama_jenis'),
        ];
        $this->JenisModel->update($id, $data);
        session()->setFlashdata('update', 'Data berhasil diperbarui!');
        return redirect()->to('/jenis');
    }

    public function delete($id)
    {
        $this->JenisModel->delete($id);
        session()->setFlashdata('error', 'Data berhasil dihapus!');
        return redirect()->to('/jenis');
    }
}
