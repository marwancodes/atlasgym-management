<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "members";

    protected $keyType = "string";

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'join_date',
        'status',
        'userId',
        'trainerId',
    ];

    protected $dates = [
        "deleted_at",
    ];

    protected function casts(): array
    { 
        return [
            'join_date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainerId', 'id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'memberId', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'memberId', 'id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'memberId', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

}
