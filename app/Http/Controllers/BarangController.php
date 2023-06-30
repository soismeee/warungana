<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return view('data_master.barang.index', [
            'title' => 'Data barang',
            'menu' => 'b',
            'submenu' => 'b',
            'kategori' => KategoriBarang::select('id','nama_kategori')->get()
        ]);
    }

    public function json(){
        $columns = ['id','kategori_id', 'nama_barang','harga_grosir', 'harga_eceran', 'stok'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Barang::select('id', 'kategori_id', 'nama_barang', 'harga_grosir', 'harga_eceran', 'stok')->with('kategori_barang');

        if(request()->input("search.value")){
            $data = $data->where(function($query){
                $query->whereRaw('nama_barang like ? ', ['%'.request()->input("search.value").'%'])
                ->orWhereRaw('stok like ? ', ['%'.request()->input("search.value")]);
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

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga_grosir' => 'required',
            'harga_eceran' => 'required',
            'stok' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => 'Data tidak bisa di inputkan',
            ]);
        } else {

            $KategoriBarang = new Barang();
            $KategoriBarang->id = intval((microtime(true) * 1000000));
            $KategoriBarang->kategori_id = $request->kategori_id;
            $KategoriBarang->nama_barang = $request->nama_barang;
            $KategoriBarang->harga_grosir = preg_replace('/[^0-9]/', '', $request->harga_grosir);
            $KategoriBarang->harga_eceran = preg_replace('/[^0-9]/', '', $request->harga_eceran);
            $KategoriBarang->stok = $request->stok;
            $KategoriBarang->save();
            return response()->json([
                'status' => 200,
                'message' => 'Barang baru berhasil ditambahkan',
            ]);
        }
    }

    public function show($id)
    {
        $b = Barang::find($id);
        if($b){
            return response()->json([
                'status' => 200,
                'data' => $b
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
        $validate = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'nama_barang' => 'required',
            'harga_grosir' => 'required',
            'harga_eceran' => 'required',
            'stok' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'errors' => 'Data tidak berhasil diambil',
            ]);
        } else {
            // select data pelaku usaha
            $update_b = Barang::find($id);
            if ($update_b) {
                // update untuk data pelaku usaha
                $update_b->kategori_id = $request->kategori_id;
                $update_b->nama_barang = $request->nama_barang;
                $update_b->harga_grosir = preg_replace('/[^0-9]/', '', $request->harga_grosir);
                $update_b->harga_eceran = preg_replace('/[^0-9]/', '', $request->harga_eceran);
                $update_b->stok = $request->stok;
                $update_b->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data berhasil diubah',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data tidak bisa di ubah',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        Barang::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data Barang berhasil di hapus',
        ]);
    }
}
