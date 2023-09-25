<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; 
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('main::index',[
			'title' => 'Role',
			'content' => view('role::index')
		]);
        // return view('dashboard::index');
    }

    public function initTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tb_role')->where([
                    ['role_deleted_at', null], 
                ])->get()->toArray();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $id = $row->role_id;
                           $btn = '<div >
                                    <a href="#" onclick="onEdit(this)" data-id="'.$id.'" title="Edit Data" class="btn btn-warning btn-sm"><i class="align-middle fa fa-pencil fw-light text-dark"> </i></a>
                                    <a href="#" onclick="onDelete(this)" data-id="'.$id.'" title="Delete Data" class="btn btn-danger btn-sm"><i class="align-middle fa fa-trash fw-light"> </i></a>
                                    <a href="#" onclick="onShowRole(this)" data-id="'.$id.'" title="Show List Menu" class="btn btn-primary btn-sm"><i class="align-middle fa fa-arrow-right fw-light"> </i></a>
                                </div>
                                ';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('role.index');
    }

    public function store(Request $request){
        $response=[];

        $data = $request->input();
        $data['role_id'] = unique_code();

        $operation = DB::table('tb_role')->insert($data);
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
        $id = $request->input('role_id');

        $operation = DB::table('tb_role')->where('role_id', $id)->get()->toArray();
        return $operation;
    }

    public function update(Request $request)
    {
        $response=[];
        $data = $request->input();

        $data['role_updated_at'] = date('Y-m-d H:i:s');

        $operation = DB::table('tb_role')->where('role_id', $data['role_id'])->update($data);

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

    public function destroy(Request $request){
        $response = [];
        $id = $request->input('role_id');

        $data = [
            'role_deleted_at' => date('Y-m-d H:i:s'),
        ];

        $operation = DB::table('tb_role')->where('role_id', $id)->update($data);

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

    public function show(Request $request)
    {
        $data = [];
        $userRoleId =  $request->input('role_id');

        // get all route
        $getAll = DB::table('tb_route')->where([
            ['route_active', 1], 
        ])->orderBy('route_order', 'ASC')->get()->toArray();
        $data['all_route'] = convertArray($getAll);

        // get route in role
        $getRole = DB::table('v_user_roles')->where([
            ['user_role_role_id', $userRoleId], 
            ])->orderBy('route_order', 'ASC')->get()->toArray();
        $data['role'] = convertArray($getRole);
        
        return $data;
    }

    public function saveRole(Request $request)
    {
        $roleId = $request->input('role_id');
        $response = [];
        $data = $request->input();
        // print_r($data);exit;
        unset($data['role_id']);

        $operationCheck = DB::table('tb_user_role')->where('user_role_role_id', $roleId)->get()->toArray();
        if($operationCheck){
            $operationDeleting = DB::table('tb_user_role')->where('user_role_role_id', $roleId)->delete();
        }

        // if($response['update'] == true){
            foreach($data as $i => $v){
                if($v == 1){
                    $dataR['user_role_id'] = unique_code();
                    $dataR['user_role_role_id'] = $roleId;
                    $dataR['user_role_route_id'] = $i;

                    $operation = DB::table('tb_user_role')->insert($dataR);

                    if($operation == 1){
                        $response['success'] = true;
                        $response['title'] = 'Success';
                        $response['message'] = 'Berhasil Mengubah Data!';
                    }else{
                        $response['success'] = false;
                        $response['title'] = 'Failed';
                        $response['message'] = 'Gagal Mengubah Data!';
                    }
                }
            }
        // }

        return $response;
    }

    public function combobox(Request $request){
        $operation = DB::table('tb_role')->whereNull('role_deleted_at')->get()->toArray();
        $data = convertArray($operation);
        return $data;
    }
   
}
