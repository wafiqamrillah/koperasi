<?php

namespace App\Models\Master\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'number',
        'name',
        'description',
        'brand',
        'is_active',
        'barcode'
    ];

    protected $guarded = [
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    
    // Closures
        /**
         * The "booted" method of the model.
         * 
         * @return void
         */
        protected static function booted()
        {
            // "Creating" data events
            static::creating(function($data){
                $data->created_by = auth()->check() ? auth()->user()->id : null;
            });

            // "Updating" data events
            static::updating(function($data){
                $data->updated_by = auth()->check() ? auth()->user()->id : null;
            });

            // "Deleting" data events
            static::deleting(function($data){
                $data->deleted_by = auth()->check() ? auth()->user()->id : null;
            });
        }

    /**
     * Get the creator that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the updater that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get the deleter that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
