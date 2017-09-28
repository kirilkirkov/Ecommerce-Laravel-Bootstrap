<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Hash;

class UsersModel extends Model
{

    private $id;

    public function getUsers()
    {
        $products = DB::table('users')->paginate(10);
        return $products;
    }

    public function setUser($post)
    {
        DB::table('users')->insert([
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            'password' => Hash::make(trim($post['password'])),
            'remember_token' => $post['_token']
        ]);
    }

    public function updateUser($post)
    {
        $password = false;
        if (mb_strlen(trim($post['password'], 'UTF-8')) > 0) {
            $password = $post['password'];
        }
        $this->id = $post['edit'];
        $update = [
            'name' => trim($post['name']),
            'email' => trim($post['email'])
        ];
        if ($password !== false) {
            $update['password'] = Hash::make(trim($post['password']));
        }
        DB::table('users')->where('id', $this->id)->update($update);
    }

    public function getOneUser($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return $user;
    }

    public function deleteUser($id)
    {
        $this->id = $id;
        DB::table('users')->where('id', $this->id)->delete();
    }

}
