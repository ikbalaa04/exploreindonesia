<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class listMessage extends Model
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

    protected $table = 'list_messages';


    public $fillable = [
        'user_id',
        'partner_id',
    ];

    public function partner()
    {
        return $this->hasOne(partners::class,'id','partner_id')->select('id','name','file','email');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id')->select('id','name','file','email');
    }
    public function lastMessage()
    {
        return $this->hasOne(message::class,'list_message_id','id')->latest();
    }
    public function message()
    {
        return $this->hasMany(message::class,'list_message_id','id')->orderBy('created_at','asc');
    }
}
