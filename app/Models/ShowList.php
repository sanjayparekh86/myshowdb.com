<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowList extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_id', // The movie_id from the API
        'title',
        'release_date',
        'genres',
        'type',
        'other_details',
    ];

    public function userRating()
    {
        return $this->hasOne(UserRating::class, 'show_list_id');
    }
}
