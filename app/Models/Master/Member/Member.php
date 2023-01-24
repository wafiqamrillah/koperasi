<?php

namespace App\Models\Master\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'id_card_number',
        'birth_place',
        'birth_date',
        'address',
        'is_married',
        'phone_number',
        'account_number',
        'is_active',
        'is_blocked'
    ];

    protected $guarded = [
        'member_id',
        'employee_id',
        'created_by',
        'created_at',
        'updated_at'
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

            // "Deleting" data events
            static::updating(function($data){
                $data->updated_by = auth()->check() ? auth()->user()->id : null;
            });

            // "Deleting" data events
            static::deleting(function($data){
                $data->deleted_by = auth()->check() ? auth()->user()->id : null;
            });
        }

    /**
     * Get the user associated with the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'member_id');
    }

    /**
     * Get the employee that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(\App\Models\Hris\Employee::class, 'employee_id');
    }

    /**
     * Get the creator that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the updater that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Get the deleter that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
