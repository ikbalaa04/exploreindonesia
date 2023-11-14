<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class detailFrontPage extends Model
{
    use HasFactory;
    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            if ( ! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    public function getIncrementing()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    protected $table = 'detail_front_pages';


    public $fillable = [
        'white_label',
        'title',
        'sub_title',
        'description',
        'file',
        'ecotourism_guide',
        'cta_name',
        'cta_url',
        'created_by',
        'updated_by',
    ];
}
