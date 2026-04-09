<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'condition',
        'status',
        'assigned_to',
        'location',
        'purchase_date',
        'warranty_expiration_date'
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'warranty_expiration_date' => 'datetime'
    ];
}
