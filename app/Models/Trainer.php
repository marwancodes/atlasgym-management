<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = "trainers";

    protected $keyType = "string";

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'specialisation',
        'salary'
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

    public function members()
    {
        return $this->hasMany(Member::class, 'trainerId', 'id');
    }


}
