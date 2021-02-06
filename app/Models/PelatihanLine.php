<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelatihanLine extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'pelatihan_line';
}
