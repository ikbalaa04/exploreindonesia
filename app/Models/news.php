<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    protected $table = 'news';
    public $fillable = ['name','file','slug','viewer','description','tag','position','type','status','created_by','updated_by'];

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
}
