<?php
// <!-- filter Role ini berfungsi pengecekan Role tertentu pada sistem ini -->
 
 namespace App\Filters;

 use CodeIgniter\HTTP\RequestInterface;
 use CodeIgniter\HTTP\ResponseInterface;
 use CodeIgniter\Filters\FilterInterface;


 class RoleFilter implements FilterInterface
 {
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('role');

        if(!empty($arguments) && !in_array($role,$arguments)){
            return redirect()->to('/')->with('error','Anda Tidak Memiliki Akses ke halaman');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //kosongkan
    }
 }
 
 
 
 ?>