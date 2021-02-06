<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direktori extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'pmi_direktori';
}
