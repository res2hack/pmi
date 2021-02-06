<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKeberangkatan extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'jadwal_keberangkatan';
}
