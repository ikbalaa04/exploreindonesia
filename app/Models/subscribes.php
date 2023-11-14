<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subscribes extends Model
{
    use HasFactory;
    protected $table = 'subscribes';
    public $fillable = ['user_id','email','count_send_email','last_send_email','status'];
}
