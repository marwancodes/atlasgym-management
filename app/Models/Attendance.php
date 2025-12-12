<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "attendance";
    protected $keyType = "string";
    public $incrementing = false;

    protected $fillable = [
        'date',
        'check_in',
        'check_out',
        'member_id',
    ];

    protected $dates = ['deleted_at'];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'deleted_at' => 'datetime',
        ];
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'memberId', 'id');
    }


}