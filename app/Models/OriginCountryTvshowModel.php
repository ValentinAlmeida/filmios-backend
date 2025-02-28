<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class OriginCountryTvshowModel extends Model
{
    use Notifiable;
    protected $table = self::TABLE;
    const TABLE = 'origin_country_tvshow';
    const LIST_TVSHOW_ID = 'list_tvshow_id';
    const SIGLA = 'sigla';

    protected $fillable = [
        self::LIST_TVSHOW_ID,
        self::SIGLA,
    ];
}
