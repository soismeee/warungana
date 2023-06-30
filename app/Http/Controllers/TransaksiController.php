<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        return view('transaksi.index', [
            'title' => 'Data Transaksi',
            'menu' => 'dt',
            'submenu' => 'dt'
        ]);
    }

    public function json(){
        $columns = ['id','nama_kategori'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Transaksi::select('id', 'tanggal_transaksi', 'jumlah_item', 'total_harga', 'status')->whereMonth('tanggal_transaksi', date('m'))->whereYear('tanggal_transaksi', date('Y'));

        if(request()->input("search.value")){
            $data = $data->where(function($query){
                $query->whereRaw('total_harga like ? ', ['%'.request()->input("search.value").'%']);
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

    public function create(){
        return view('transaksi.create', [
            'title' => 'Transaksi Penjualan',
            'menu' => 't',
            'submenu' => 't',
            'barang' => Barang::select('id','nama_barang')->with('kategori_barang')->get()
        ]);
    }

    public function getBarang(Request $request, $id){
        $kategori_harga = $request->kategori_harga;

        $barang = Barang::find($id);
        if($kategori_harga == "eceran"){
            $harga = $barang->harga_eceran;
        }else{
            $harga = $barang->harga_grosir;
        }
        $data = [
            'id' => $barang->id,
            'nama_barang' => $barang->nama_barang,
            'stok' => $barang->stok,
            'harga' => $harga,
        ];

        if($barang){
            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'errors' => "Data tidak dapat ditemukan"
            ]);
        }
    }

    public function store(Request $request){
        if($request->grand_total ){
            $total_barang = 0;
            $jumlah_uttp = $request->jml_barang;
            foreach($jumlah_uttp as $item => $values){$total_barang += $values;}

            $transaksi = new Transaksi();
            $transaksi->id = date("YmdHis").intval(microtime(true));
            $transaksi->tanggal_transaksi = date("Y-m-d");
            $transaksi->jumlah_item = $total_barang;
            $transaksi->total_harga = $request->grand_total;
            $transaksi->save();

            $trans_id = $transaksi->id;
            $detail = $request->nama_barang;
            foreach($detail as $key => $value){
                DetailTransaksi::create([
                    'trans_id' => $trans_id,
                    'nama_barang' => $request->nama_barang[$key],
                    'kategori_harga' => $request->kategori_harga[$key],
                    'harga_barang' => $request->harga_barang[$key],
                    'jml_barang' => $request->jml_barang[$key],
                    'total_harga' => $request->jml_barang[$key]*$request->harga_barang[$key],
                ]);
            }
            return response()->json([
                'status' => 200,
                'trans_id' => $trans_id,
                'message' => 'Transaksi berhasil dilakukan'
            ]);
        }else{
            return response()->json([
                'status' => 401,
                'errors' => 'Transaksi gagal dilakukan'
            ]);
        }
    }

    public function show($id){
        return view('transaksi.show', [
            'title' => 'Detail transaksi',
            'menu' => 'dt',
            'submenu' => 'dt',
            'data' => DetailTransaksi::where('trans_id', $id)->get(),
            'transaksi' => Transaksi::find($id)
        ]);
    }

    public function print($id){
        return view('transaksi.print', [
            'title' => 'Print Struk',
            'transaksi' => Transaksi::find($id),
            'detail' => DetailTransaksi::where('trans_id', $id)->get()
        ]);
    }

    public function destroy($id)
    {
        Transaksi::destroy($id);
        return response()->json([
            'status' => 200,
            'message' => 'Data transaksi berhasil di hapus',
        ]);
    }
}
