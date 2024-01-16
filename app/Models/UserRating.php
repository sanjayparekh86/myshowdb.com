<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'show_list_id',
        'comment',
        'user_rating',
        'watch_date',
        'watch_status',
    ];

    public function showList()
    {
        return $this->belongsTo(ShowList::class);
    }
}
