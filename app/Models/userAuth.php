<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class userAuth extends Model
{
    use HasFactory,HasApiTokens;
    public $timestamps = false;
    public $table='userauth';
    protected $fillable =[
        'name','email','password'
    ];
}
