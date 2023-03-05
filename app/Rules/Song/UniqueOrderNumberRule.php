<?php

namespace App\Rules\Song;

use App\Models\Album;
use App\Models\Song;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class UniqueOrderNumberRule implements Rule, DataAwareRule
{
    private array $_data;
    private ?Song $_song;

    public function __construct(Song $song = null)
    {
        $this->_song = $song;
    }

    public function passes($attribute, $value): bool
    {
        $albumId = $this->_data['albumId'] ?? $this->_song->album_id;
        $orderNumberInAlbum = $this->_data['orderNumberInAlbum'] ?? $this->_song->order_number_in_album;
        $album = Album::where('id', $albumId)->get();
        return $album->first()->songs->every(fn($song) => $song->order_number_in_album != $orderNumberInAlbum);
    }

    public function message(): string
    {
        return 'Песня с таким "orderNumberInAlbum" уже есть в альбоме';
    }

    public function setData($data): void
    {
        $this->_data = $data;
    }
}
