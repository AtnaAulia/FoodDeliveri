<?php
// <!-- filter Auth ini berfungsi pengecekan apakah user sudah login apa belum pada sistem ini -->
 
 namespace App\Filters;

 use CodeIgniter\HTTP\RequestInterface;
 use CodeIgniter\HTTP\ResponseInterface;
 use CodeIgniter\Filters\FilterInterface;


 class AuthFilter implements FilterInterface
 {
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('islogin')){
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //kosongkan
    }
 }
 
 
 
 ?>