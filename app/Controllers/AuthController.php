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
    public function login ()
    {
        return view('auth/login');
    }

    public function doLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $user = $this->userModel->getUsername($username);
        if(!$user){
            return redirect()->back()->with('error','Username Tidak Ditemukan');
        }

        if(!password_verify($password,$user['password'])){
            return redirect()->back()->with('error','Password salah');
        }

        //simpan data user dan role disession

        session()->set([
            'islogin' => true,
            'user_id' => $user['id'],
            'nama' => $user['nama'],
            'role' => $user['role'],
            'foto' => $user['foto']
        ]);
        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
