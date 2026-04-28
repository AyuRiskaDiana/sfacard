<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    // ===============================
    // HALAMAN LOGIN
    // ===============================
    public function login()
    {
        return view('auth/login');
    }

    // ===============================
    // PROSES LOGIN
    // ===============================
    public function prosesLogin()
    {
        $session = session();
        $usersModel = new UsersModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $users = $usersModel->getUsersByUsername($username);

        if ($users) {

            if (password_verify($password, $users['password'])) {

                // SESSION LOGIN (WAJIB id_user)
                $session->set([
                    'id_user'   => $users['id_user'],
                    'nama'      => $users['nama'],
                    'username'  => $users['username'],
                    'role'      => $users['role'],
                    'foto'      => $users['foto'] ?? null,
                    'logged_in' => true
                ]);

                return redirect()->to('/dashboard');

            } else {

                $session->setFlashdata(
                    'salahpw',
                    'Password salah'
                );

                return redirect()->to('/login');
            }

        } else {

            $session->setFlashdata(
                'error',
                'Username tidak ditemukan'
            );

            return redirect()->to('/login');
        }
    }

    // ===============================
    // LOGOUT
    // ===============================
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}