<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function getInquiryEmailAttribute()
    {
        return $this->attributes['email'] ?? 'default@example.com';
    }
}
