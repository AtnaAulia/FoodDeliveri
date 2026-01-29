<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','username','password','role','foto'];


    public function getUsername($username)
    {
        return $this->where('username',$username)->first();
    }
   
}
