<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class ListModel extends Model
{
    use Notifiable;
    protected $table = 'list';
    const TITLE = 'title';
    const USER_ID = 'user_id';
    const DESCRIPTION = 'description';

    protected $fillable = [
        self::TITLE,
        self::USER_ID,
        self::DESCRIPTION,
    ];

    public function movie()
    {
        return $this->hasMany(ListMovieModel::class, ListMovieModel::LIST_ID);
    }

    public function tvShow()
    {
        return $this->hasMany(ListTvShowModel::class, ListTvShowModel::LIST_ID);
    }
}
