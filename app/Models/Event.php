<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'img',
        'begin_time',
        'end_time',
        'max_people',
        'limit',
        'requires_payment',
        'requires_membership',
        'send_mail',
        'active',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['registered_at'])
            ->withTimestamps();
    }
}
