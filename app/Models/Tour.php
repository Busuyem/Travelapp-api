<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function price():Attribute
    {
        return Attribute::make(
            get: fn($value) => $value/100,
            set: fn($value) => $value *100
        );
    }
}