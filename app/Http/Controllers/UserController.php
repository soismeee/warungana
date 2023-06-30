<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function index(){
        return view('users.index', [
            'title' => 'Data User pengguna',
            'menu' => 'usr',
            'submenu' => 'usr',
        ]);
    }

    public function json(){
        $columns = ['id','name','username'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = User::select('id', 'name', 'username');

        if(request()->input("search.value")){
            $data = $data->where(function($query){
                $query->whereRaw('name like ? ', ['%'.request()->input("search.value").'%'])
                ->orWhereRaw('username like ? ', ['%'.request()->input("search.value").'%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        if(request()->input("length") == -1):
            $data = $data->take(request()->input('length'))->get();
        else:
            $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy,request()->input("order.0.dir"))->get();
        endif;
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }


    public function store(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => 'Data tidak bisa di inputkan',
            ]);
        } else {

            $user = new User();
            $user->id = intval((microtime(true) * 10000));
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'User baru berhasil ditambahkan',
            ]);
        }
    }

    public function show($id)
    {
        $usr = User::find($id);
        if($usr){
            return response()->json([
                'status' => 200,
                'data' => $usr
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'data tidak ditemukan'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required',
        ]);

        if ($request->password !== null) {
            $rules['password'] = Hash::make($request->password);
        }
        User::where('id', $id)->update($rules);
        return response()->json([
            'status' => 200,
            'message' => 'Data user berhasil di ubah',
        ]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data user pengguna berhasil di hapus',
        ]);
    }
}
