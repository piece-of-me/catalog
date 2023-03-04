<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int album_id
 * @property string name
 * @property int order_number_in_album
 */
class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';
    protected $guarded = false;
    public $timestamps = false;

    public function album()
    {
        return $this->hasOne(Album::class, 'id', 'album_id');
    }
}
