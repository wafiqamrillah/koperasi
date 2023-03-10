<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "has_translation",
        "value",
    ];

    protected $guarded = [
        "key"
    ];
}
