<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminAccount_model extends Authenticatable
{
    use HasFactory;
    protected $table = 'admin_account';

    protected $fillable = [
        'username',
        'password',
    ];


    public $timestamps = false;
}
