<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'sort',
        'label',
        'link_type',
        'link',
        'icon_class',
        'has_translation',
        'is_active',
    ];

    protected $guarded = [
        "parent_id",
        "is_active",
        'has_translation',
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

    // Scopes
        public function scopeActive($query)
        {
            return $query->where('is_active', true);
        }

        public function scopeMainMenu($query)
        {
            return $query->whereNull('parent_id')->orWhere('parent_id', 0);
        }

        public function scopeOrderSort($query, $order = 'asc')
        {
            return $query->orderBy('sort', $order);
        }
}
