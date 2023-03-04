<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Executor extends Model
{
    use HasFactory;

    protected $table = 'executors';
    protected $guarded = false;
    public $timestamps = false;

    public function albums() {
        return $this->hasMany(Album::class);
    }
}
