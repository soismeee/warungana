<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(){
        return view('data_master.kategori.index', [
            'title' => 'Data Kategori Barang',
            'menu' => 'kb',
            'submenu' => 'kb',
        ]);
    }

    public function json(){
        $columns = ['id','nama_kategori'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = KategoriBarang::select('id', 'nama_kategori',);

        if(request()->input("search.value")){
            $data = $data->where(function($query){
                $query->whereRaw('nama_kategori like ? ', ['%'.request()->input("search.value").'%']);
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
            'nama_kategori' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => 'Data tidak bisa di inputkan',
            ]);
        } else {

            $KategoriBarang = new KategoriBarang();
            $KategoriBarang->id = intval((microtime(true) * 1000000));
            $KategoriBarang->nama_kategori = $request->nama_kategori;
            $KategoriBarang->save();
            return response()->json([
                'status' => 200,
                'message' => 'Kategori Barang baru berhasil ditambahkan',
            ]);
        }
    }

    public function show($id)
    {
        $kb = KategoriBarang::find($id);
        if($kb){
            return response()->json([
                'status' => 200,
                'data' => $kb
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
        $rules = $request->validate(['nama_kategori' => 'required|max:255',]);
        KategoriBarang::where('id', $id)->update($rules);
        return response()->json([
            'status' => 200,
            'message' => 'Data Kategori Barang berhasil di ubah',
        ]);
    }

    public function destroy($id)
    {
        KategoriBarang::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data Kategori Barang berhasil di hapus',
        ]);
    }
}
