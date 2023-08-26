<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembelianController extends Controller
{

    public function index()
    {
        return view('pembelian.index', [
            'title' => 'Data pembelian',
            'menu' => 'pembelian',
            'submenu' => 'pb',
        ]);
    }


    public function create()
    {
        return view('pembelian.create', [
            'title' => 'Input pembelian',
            'menu' => 'pembelian',
            'submenu' => 'pbc',
        ]);
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
