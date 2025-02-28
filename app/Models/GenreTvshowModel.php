<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class GenreTvshowModel extends Model
{
    use Notifiable;
    protected $table = self::TABLE;
    const ID = 'id';
    const TABLE = 'genre_tvshow';
    const LIST_TVSHOW_ID = 'list_tvshow_id';

    protected $fillable = [
        self::LIST_TVSHOW_ID,
        self::ID,
    ];
}
