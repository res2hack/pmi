<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPage extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;
    
    public $timestamps = false;
    protected $table = 'post_pages';
}
