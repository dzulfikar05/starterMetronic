<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 
use Modules\User\Entities\User;

use DataTables;


class UserController extends Controller
{
    public function index()
    {
        return view('main::index',[
			'title' => 'User',
			'content' => view('user::index')
		]);
    }

    public function initTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tb_user')->where([
                    ['user_deleted_at', null], 
                ])->get()->toArray();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->user_id;
                           $btn = '<div >
                                        <a href="#" onclick="onEdit(this)" data-id="'.$id.'" title="Edit Data" class="btn btn-warning btn-sm"><i class="align-middle fa fa-pencil fw-light text-dark"> </i></a>
                                        <a href="#" onclick="onDelete(this)" data-id="'.$id.'" title="Delete Data" class="btn btn-danger btn-sm"><i class="align-middle fa fa-trash fw-light"> </i></a>
                                </div>
                                ';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('user.index');
    }

    public function store(Request $request){
        $response=[];

        $data = $request->input();
       
        $image = $request->file('user_photo');

        $data['user_id'] = uniqid();
        $data['user_created_at'] = date('Y-m-d H:i:s');
        $data['user_password'] = bcrypt($data['user_password']);

        if(isset($data['user_active'])){
            $data['user_active'] = 1;
        }else{
            $data['user_active'] = 0;
        }

        if($image){
            $image->storeAs('public/uploads/user', $image->hashName());
            $data['user_photo'] = $image->hashName();
        }

        $operation = DB::table('tb_user')->insert($data);
        if($operation == 1){
            $response['success'] = true;
            $response['title'] = 'Success';
            $response['message'] = 'Berhasil Menambahkan Data';
        }else{
            $response['success'] = false;
            $response['title'] = 'Failed';
            $response['message'] = 'Gagal Mengubah Data!';
        }

        return $response;
    }

    public function edit(Request $request){
        $id = $request->input('user_id');

        $operation = DB::table('tb_user')->where('user_id', $id)->get()->toArray();

        return $operation;
    }

    public function update(Request $request)
    {
        $response=[];
        $image = $request->file('user_photo');

        $data = $_POST;
        
        $data['user_updated_at'] = date('Y-m-d H:i:s');

        if(isset($data['user_password'])){
            $data['user_password'] = bcrypt($data['user_password']);

            if($data['user_password'] == '' || $data['user_password'] == null){
                unset($data['user_password']);
            }
        }

        if($image){
            $image->storeAs('public/uploads/user', $image->hashName());
            $data['user_photo'] = $image->hashName();
        }

        $operation = DB::table('tb_user')->where('user_id', $data['user_id'])->update($data);

        if($operation == 1){
            // $users = DB::table('tb_user')->where('user_id', $data['user_id'])->get()->toArray();
            // session(['userdata' => $users[0]]);
            // $request->session()->put('userdata', $users[0]);
            

            $response['success'] = true;
            $response['title'] = 'Success';
            $response['message'] = 'Berhasil Mengubah Data!';
        }else{
            $response['success'] = false;
            $response['title'] = 'Failed';
            $response['message'] = 'Gagal Mengubah Data!';
        }
        return $response;
    }

    public function destroy(Request $request){
        $response = [];
        $id = $request->input('user_id');

        $user = DB::table('tb_user')->where('user_id', $id)->get()->toArray();
        $data = [
            'user_deleted_at' => date('Y-m-d H:i:s'),
            'user_active' => null
        ];
        $operation = DB::table('tb_user')->where('user_id', $id)->update($data);
        Storage::disk('local')->delete('public/uploads/user/'.$user[0]->user_photo);

        if($operation == 1){
            $response['success'] = true;
            $response['title'] = 'Success';
            $response['message'] = 'Berhasil Mengubah Data!';
        }else{
            $response['success'] = false;
            $response['title'] = 'Failed';
            $response['message'] = 'Gagal Mengubah Data!';
        }
        return $response;
    }
}
