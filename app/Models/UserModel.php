<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'tb_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['email','password','role'];

    public function getUserLogin($email)
    {
        return $this->db->table('tb_user')
        ->select('*')
        ->where('email', $email)
            ->get()
            ->getRowArray();
    }
}
