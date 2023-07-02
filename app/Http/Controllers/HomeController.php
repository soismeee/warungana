<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $harian = Transaksi::whereDate('tanggal_transaksi', date('Y-m-d'))->sum('total_harga');
        $harian_kemarin = Transaksi::whereDate('tanggal_transaksi', date('Y-m-d', strtotime('-1 days')))->sum('total_harga');
        $bulanan = Transaksi::whereMonth('tanggal_transaksi', date('m'))->whereYear('tanggal_transaksi',date('Y'))->sum('total_harga');
        $bulanan_kemarin = Transaksi::whereMonth('tanggal_transaksi', date('m', strtotime('-1 month')))->whereYear('tanggal_transaksi',date('Y'))->sum('total_harga');
        $tahunan = Transaksi::whereYear('tanggal_transaksi', date('Y'))->sum('total_harga');
        return view('home.index', [
            'title' => 'Home',
            'menu' => 'home',
            'submenu' => 'home',
            'harian' => $harian,
            'harian_kemarin' => $harian_kemarin,
            'bulanan' => $bulanan,
            'bulanan_kemarin' => $bulanan_kemarin,
            'tahunan' => $tahunan,
        ]);
    }

    public function json_harian(){
        $harian = DetailTransaksi::whereDate('created_at', date('Y-m-d'));
        if ($harian->count() > 0) {
            $no = 1;
            $grand_total = 0;
            foreach ($harian->get() as $item) {
                $data[] = [
                    'no' => $no,
                    'nama' => $item->nama_barang,
                    'kategori' => $item->kategori_harga,
                    'jumlah' => $item->jml_barang,
                    'harga' => $item->harga_barang,
                    'total' => $item->total_harga,
                ];
                $grand_total += $item->total_harga;
                $no++;
            }
            return response()->json([
                'status' => 200,
                'data' => $data,
                'grandtotal' => $grand_total
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => "Belum ada transaksi di hari ini"
            ]);
        }
        
    }
}
