<?php

namespace App\Rules;

use App\Models\Song;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class UniqueSong implements Rule, DataAwareRule
{
    private array $_data;
    private ?Song $_song;
    private string $_message = '';

    public function __construct(Song $song = null)
    {
        $this->_song = $song;
    }

    public function passes($attribute, $value): bool
    {
        $name = $this->_data['name'] ?? $this->_song->name;
        $orderNumberInAlbum = $this->_data['orderNumberInAlbum'] ?? $this->_song->order_number_in_album;
        $song = Song::where('name', $name)->get();
        if ($song->count() <= 0) {
            return true;
        }
        $song = $song->filter(fn($curSong) => $curSong->order_number_in_album == $orderNumberInAlbum);
        if ($song->count() <= 0) {
            return true;
        }
        $this->_message = 'Песня "' . $name . '" c таким же порядковым номером уже есть в альбоме "' . $song->first()->album->name . '"';
        return false;
    }

    public function message(): string
    {
        return $this->_message;
    }

    public function setData($data)
    {
       $this->_data = $data;
    }
}
