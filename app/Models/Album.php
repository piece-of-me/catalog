<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int executor_id
 * @property string name
 * @property int year_of_issue
 */
class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';
    protected $guarded = false;
    public $timestamps = false;

    public function executor()
    {
        return $this->hasOne(Executor::class, 'id', 'executor_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
