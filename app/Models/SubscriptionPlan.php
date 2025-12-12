<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "subscription_plans";

    protected $keyType = "string";

    public $incrementing = false;

    protected $fillable = [
        'name',
        'price',
        'duration_in_day',
        'description'
    ];

    protected $dates = [
        "deleted_at",
    ];

    protected function casts(): array
    { 
        return [
            'deleted_at' => 'datetime',
        ];
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'planId', 'id');
    }

}
