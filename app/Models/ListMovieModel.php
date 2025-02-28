<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

class ListMovieModel extends Model
{
    use Notifiable;
    protected $table = self::TABLE;
    const TABLE = 'list_movie_model';
    const ID = 'id';
    const BACKDROP_PATH = 'backdrop_path';
    const TITLE = 'title';
    const OVERVIEW = 'overview';
    const POSTER_PATH = 'poster_path';
    const MEDIA_TYPE = 'media_type';
    const POPULARITY = 'popularity';
    const RELEASE_DATE = 'release_date';
    const VOTE_AVERAGE = 'vote_average';
    const ADULT = 'adult';
    const ASSISTED = 'assisted';
    const FAVORITED = 'favorited';
    const LIST_ID = 'list_id';

    protected $fillable = [
        self::BACKDROP_PATH,
        self::ID,
        self::TITLE,
        self::OVERVIEW,
        self::POSTER_PATH,
        self::MEDIA_TYPE,
        self::POPULARITY,
        self::RELEASE_DATE,
        self::VOTE_AVERAGE,
        self::ADULT,
        self::ASSISTED,
        self::FAVORITED,
        self::LIST_ID,
    ];

    public function genre()
    {
        return $this->hasMany(GenreMovieModel::class, GenreMovieModel::LIST_MOVIE_ID, self::ID);
    }
}
