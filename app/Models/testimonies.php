<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonies extends Model
{
    use HasFactory;
    protected $table = 'testimonies';
    public $fillable = ['name','title','file','website','rating','description','position','status','created_by','updated_by'];
}
