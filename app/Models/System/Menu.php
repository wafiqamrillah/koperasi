<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort',
        'title',
        'parent_id',
        'link',
        'link_type',
        'icon_class',
        'has_translation',
        'is_active',
    ];

    protected $guarded = [
        "title",
        "parent_id",
        "is_active"
    ];

    protected $with = ["childs"];
    
    /**
     * Get all of the childs for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
