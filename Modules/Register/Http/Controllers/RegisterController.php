<?php

namespace Modules\Register\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;



class RegisterController extends Controller
{
    public function index()
    {
        return view('register::index');
    }

    public function store(Request $request)
    {
        $response = [];
        $data = $request->except(['_token']);
        // $image = $request->file('user_photo');

        $data['user_id'] = uniqid();
        $data['user_role'] = 1;
        $data['user_created_at'] = date('Y-m-d H:i:s');
        $data['user_password'] = bcrypt($data['user_password']);
        $data['user_active'] = 1;

        $check = DB::table('tb_user')->where('user_email', $data['user_email'])->get()->toArray();
        // dd($data);
        if (count($check) > 0) {
            $response['success'] = false;
            $response['title'] = 'Failed';
            $response['message'] = 'Gagal! Data Anda Sudah Terdaftar';
        } else {
            $operation = DB::table('tb_user')->insert($data);

            if ($operation == 1) {
                $response['success'] = true;
                $response['title'] = 'Success';
                $response['message'] = 'Register Berhasil ! Silahkan Login';
            } else {
                $response['success'] = false;
                $response['title'] = 'Failed';
                $response['message'] = 'Gagal Mengubah Data!';
            }
        }

        return $response;
    }
}
