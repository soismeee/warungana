<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekapanController extends Controller
{
    public function harian(){
        return view('rekapan.harian', [
            'title' => 'Rekapan harian',
            'menu' => 'rekap',
            'submenu' => 'rh'    
        ]);
    }

    public function getRekapHarian(){
        $tanggal = request('tanggal');
        $transaksi = Transaksi::whereDate('tanggal_transaksi', $tanggal);
        $pendapatan = $transaksi->sum('total_harga');
        $penjualan = $transaksi->sum('jumlah_item');
        
        return response()->json([
            'status' => 200,
            'pendapatan' => $pendapatan,
            'penjualan' => $penjualan
        ]);
    }

    public function json_harian(){
        $columns = ['id'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Transaksi::select('id', 'tanggal_transaksi', 'jumlah_item', 'total_harga', 'status')->whereDate('tanggal_transaksi', request('tanggal'));

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

    public function bulanan(){
        return view('rekapan.bulanan', [
            'title' => 'Rekapan bulanna',
            'menu' => 'rekap',
            'submenu' => 'rb'    
        ]);
    }

    public function getRekapBulanan(){
        $tanggal = request('tanggal');
        $month = date('m', strtotime($tanggal));
        $year = date('Y', strtotime($tanggal));
        $transaksi = Transaksi::whereMonth('tanggal_transaksi', $month)->whereYear('tanggal_transaksi', $year);
        $pendapatan = $transaksi->sum('total_harga');
        $penjualan = $transaksi->sum('jumlah_item');
        
        return response()->json([
            'status' => 200,
            'pendapatan' => $pendapatan,
            'penjualan' => $penjualan
        ]);
    }

    public function json_bulanan(){
        $tanggal = request('tanggal')."-01";
        $bulan = date('m', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
        $data = DB::table('transaksis')->whereMonth('tanggal_transaksi', $bulan)->whereYear('tanggal_transaksi', $tahun)->groupBy('tanggal_transaksi');
        $no = 1;
        $datatampung = [];
        foreach ($data->get() as $item) {
            $dataitem = [
                'no' => $no,
                'tanggal' => date('Y-m-d', strtotime($item->tanggal_transaksi)),
                'jumlah' => DB::table('transaksis')->whereDate('tanggal_transaksi', date('Y-m-d', strtotime($item->tanggal_transaksi)))->get()->sum('jumlah_item'),
                'harga' => DB::table('transaksis')->whereDate('tanggal_transaksi', date('Y-m-d', strtotime($item->tanggal_transaksi)))->get()->sum('total_harga'),
            ];
            $datatampung[] = $dataitem;
            $no++;
        }

        $columns = ['id'];
        $orderBy = $columns[request()->input("order.0.column")];

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
            'data' => $datatampung
        ]);
    }

    public function getDetailRekapBulanan(){
        $tanggal = request('tanggal');
        $transaksi = DetailTransaksi::whereDate('created_at', $tanggal)->get();

        if ($transaksi) {
            return response()->json([
                'status' => 200,
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        
    }

    public function tahunan(){
        return view('rekapan.tahunan', [
            'title' => 'Rekapan tahunan',
            'menu' => 'rekap',
            'submenu' => 'rt'    
        ]);
    }

    public function json_tahunan(){
        // $tanggal = request('tanggal');
        $tahun = request('tanggal');

        $data[] = [
            'jan' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '01')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '01')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '01')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '01')->sum('total_harga')
            ],
            'feb' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '02')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '02')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '02')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '02')->sum('total_harga')
            ],
            'mar' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '03')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '03')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '03')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '03')->sum('total_harga')
            ],
            'apr' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '04')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '04')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '04')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '04')->sum('total_harga')
            ],
            'mei' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '05')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '05')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '05')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '05')->sum('total_harga')
            ],
            'jun' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '06')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '06')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '06')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '06')->sum('total_harga')
            ],
            'jul' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '07')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '07')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '07')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '07')->sum('total_harga')
            ],
            'agt' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '08')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '08')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '08')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '08')->sum('total_harga')
            ],
            'sep' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '09')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '09')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '09')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '09')->sum('total_harga')
            ],
            'okt' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '10')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '10')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '10')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '10')->sum('total_harga')
            ],
            'nov' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '11')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '11')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '11')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '11')->sum('total_harga')
            ],
            'des' => [
                'harga' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '12')->sum('total_harga'),
                'jumlah' => Transaksi::whereYear('tanggal_transaksi', $tahun)->whereMonth('tanggal_transaksi', '12')->sum('jumlah_item'),
                'eceran' => DetailTransaksi::where('kategori_harga', 'eceran')->whereYear('created_at', $tahun)->whereMonth('created_at', '12')->sum('total_harga'),
                'grosir' => DetailTransaksi::where('kategori_harga', 'grosir')->whereYear('created_at', $tahun)->whereMonth('created_at', '12')->sum('total_harga')
            ],
        ];

        return response()->json([
            'data' => $data,
        ]);
    }

    public function getRekapTahunan(){
        $year = request('tanggal');
        $transaksi = Transaksi::whereYear('tanggal_transaksi', $year);
        $pendapatan = $transaksi->sum('total_harga');
        $penjualan = $transaksi->sum('jumlah_item');
        
        return response()->json([
            'status' => 200,
            'pendapatan' => $pendapatan,
            'penjualan' => $penjualan
        ]);
    }
}
