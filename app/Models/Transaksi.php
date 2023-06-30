<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';
    public $incrementing = false;

    public function detail_transaksi(){
        return $this->hasMany(DetailTransaksi::class, 'id');
    }
}
