<?php

namespace App\Models\Master\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_card_number',
        'birth_place',
        'birth_date',
        'address',
        'is_married',
        'phone_number',
        'account_number',
        'is_active'
    ];

    protected $guarded = [
        'member_id',
        'created_by',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user associated with the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'member_id');
    }
}
