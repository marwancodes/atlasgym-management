<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "payments";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'amount',
        'payment_method',
        'payment_date',
        'status',
        'memberId',
        'subscriptionId',
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'payment_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberId', 'id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscriptionId', 'id');
    }

}
