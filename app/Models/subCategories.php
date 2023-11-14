<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategories extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';
    public $fillable = ['categories_id','name','slug','type','brosur','description','detail','file','link_tokopedia','link_bukalapak','status','created_by','updated_by'];

    public function category()
    {
        return $this->hasOne(categories::class,'id','categories_id');
    }
}
