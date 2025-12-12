<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "subscriptions";

    protected $keyType = "string";

    public $incrementing = false;

    protected $fillable = [
        'start_date',
        'end_date',
        'status',
        'memberId',
        'planId',
    ];

    protected $dates = [
        "deleted_at",
    ];

    protected function casts(): array
    { 
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberId', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'planId', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'subscriptionId', 'id');
    }

}
