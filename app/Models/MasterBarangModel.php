<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarangModel extends Model
{
    use HasFactory;
    protected $table = 'master_barang';
    public $timestamp = false ;

}
