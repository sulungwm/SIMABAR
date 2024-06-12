<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    
    }

    public function index()
    {
        $title = 'Login Pengguna';
        return view('auth/login', compact('title'));
    }

    public function login()
    {
        // Validasi form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->getUserLogin($email);

        if ($user && password_verify($password, $user['password'])) {
            $userData = [
                'id_user' => $user['id_user'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => TRUE
            ];

            session()->set($userData);
            // dd($userData);

            return redirect()->to('/');
        } else {
            return redirect()->back()->withInput()->with('error', 'email atau password salah.');
        }
    }


    // Logout
    public function logout()
    {
        // Clear all session data
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/');
    }
}
