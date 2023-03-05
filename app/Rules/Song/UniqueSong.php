<?php

namespace App\Rules\Song;

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
        $albumId = $this->_data['albumId'] ?? $this->_song->album_id;
        $song = Song::where('name', $name)->get();

        if ($song->filter(fn($curSong) => $curSong->album_id == $albumId)->count() > 0) {
            $this->_message = 'Песня "' . $name . '" уже есть в альбоме';
            return false;
        }
        if ($song->filter(fn($curSong) => $curSong->order_number_in_album == $orderNumberInAlbum)->count() > 0) {
            $this->_message = 'Песня "' . $name . '" c таким же порядковым номером уже есть в другом альбоме';
            return false;
        }
        return true;
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
