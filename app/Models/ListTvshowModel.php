<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ListTvShowModel extends Model
{
    use Notifiable;
    protected $table = self::TABLE;
    const TABLE = 'list_tvshow';
    const ID = 'id';
    const LIST_ID = 'list_id';
    const ADULT = 'adult';
    const ASSISTED = 'assisted';
    const FAVORITED = 'favorited';
    const BACKDROP_PATH = 'backdrop_path';
    const ORIGINAL_LANGUAGE = 'original_language';
    const OVERVIEW = 'overview';
    const POSTER_PATH = 'poster_path';
    const NAME = 'name';
    const POPULARITY = 'popularity';
    const VOTE_AVERAGE = 'vote_average';

    protected $fillable = [
        self::LIST_ID,
        self::ID,
        self::ADULT,
        self::ASSISTED,
        self::FAVORITED,
        self::BACKDROP_PATH,
        self::ORIGINAL_LANGUAGE,
        self::OVERVIEW,
        self::POSTER_PATH,
        self::NAME,
        self::POPULARITY,
        self::VOTE_AVERAGE,
    ];

    public function genre()
    {
        return $this->hasMany(GenreTvshowModel::class, GenreTvshowModel::LIST_TVSHOW_ID, self::ID);
    }

    public function originCountry()
    {
        return $this->hasMany(OriginCountryTvshowModel::class, OriginCountryTvshowModel::LIST_TVSHOW_ID, self::ID);
    }
}
