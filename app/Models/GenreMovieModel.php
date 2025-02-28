<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class GenreMovieModel extends Model
{
    use Notifiable;
    protected $table = self::TABLE;
    const ID = 'id';
    const TABLE = 'genre_movie';
    const LIST_MOVIE_ID = 'list_movie_id';

    protected $fillable = [
        self::LIST_MOVIE_ID,
        self::ID,
    ];
}
