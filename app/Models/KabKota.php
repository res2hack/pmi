<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabKota extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'kedatangan_kabkota';
}
