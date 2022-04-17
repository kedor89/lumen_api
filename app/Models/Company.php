<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nip', 'address', 'city', 'postal_code'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

}
