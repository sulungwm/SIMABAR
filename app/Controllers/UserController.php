<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data['user'] = $this->UserModel->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function add()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' =>  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role')
        ];

        $this->UserModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $user = $this->UserModel->find($id);

        $data = [
            'user' => $user,
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {

        $data = [
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role')
        ];

        $this->UserModel->update($id, $data);
        session()->setFlashdata('update', 'Data berhasil diperbarui!');
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);
        session()->setFlashdata('error', 'Data berhasil dihapus!');
        return redirect()->to('/user');
    }
}
