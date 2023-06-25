<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiModel extends Model
{
    protected $table = 'tb_pegawai';
    const CREATED_AT = null;
    const UPDATED_AT = null;
    protected $fillable = ['*'];
    protected $hidden = ['password'];

    use HasFactory;
}