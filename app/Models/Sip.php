<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sip extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'pmi_sip';
}
