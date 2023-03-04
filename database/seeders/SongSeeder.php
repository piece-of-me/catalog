<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SongSeeder extends Seeder
{
    private array $songs = [
        AlbumSeeder::SLIPKNOT => [[
            'name' => 'Eyeless',
            'number' => 3,
        ], [
            'name' => 'Wait and Bleed',
            'number' => 4,
        ], [
            'name' => 'Surfacing',
            'number' => 5,
        ]],
        AlbumSeeder::IOWA => [[
            'name' => 'Disasterpiece',
            'number' => 3,
        ], [
            'name' => 'My Plague',
            'number' => 4,
        ], [
            'name' => 'Everything Ends',
            'number' => 5,
        ]],
        AlbumSeeder::ALL_HOPE_IS_GONE => [[
            'name' => 'Sulfur',
            'number' => 3,
        ], [
            'name' => 'Psychosocial',
            'number' => 4,
        ], [
            'name' => 'Dead Memories',
            'number' => 5,
        ]],
        AlbumSeeder::HERZELEID => [[
            'name' => 'Der Meister',
            'number' => 2,
        ], [
            'name' => 'Heirate mich',
            'number' => 8,
        ], [
            'name' => 'Rammstein',
            'number' => 11,
        ]],
        AlbumSeeder::SEHNSUCTH => [[
            'name' => 'Engel',
            'number' => 2,
        ], [
            'name' => 'Klavier',
            'number' => 8,
        ], [
            'name' => 'Eifersucht',
            'number' => 10,
        ]],
        AlbumSeeder::MUTTER => [[
            'name' => 'Mein Herz brennt',
            'number' => 1,
        ], [
            'name' => 'Links 2-3-4',
            'number' => 2,
        ], [
            'name' => 'Sonne',
            'number' => 3,
        ]],
        AlbumSeeder::WITHOUT_PRESERVATIVES => [[
            'name' => 'Sid & Nancy',
            'number' => 1,
        ], [
            'name' => 'Харакири',
            'number' => 2,
        ], [
            'name' => 'Отвалите!',
            'number' => 3,
        ]],
        AlbumSeeder::THREE_WAYS => [[
            'name' => 'C-4',
            'number' => 1,
        ], [
            'name' => 'С небес на землю',
            'number' => 2,
        ], [
            'name' => 'Три пути',
            'number' => 3,
        ]],
        AlbumSeeder::LIBERTY => [[
            'name' => 'Между строчек',
            'number' => 1,
        ], [
            'name' => 'Детки',
            'number' => 2,
        ], [
            'name' => 'Зубы',
            'number' => 3,
        ]],
        AlbumSeeder::RIDE_THE_LIGHTNING => [[
            'name' => 'Fight Fire with Fire',
            'number' => 1,
        ], [
            'name' => 'Trapped Under Ice',
            'number' => 5,
        ], [
            'name' => 'Escape',
            'number' => 6,
        ]],
        AlbumSeeder::MASTER_OF_PUPPETS => [[
            'name' => 'Battery',
            'number' => 1,
        ], [
            'name' => 'Master of Puppets',
            'number' => 2,
        ], [
            'name' => 'Orion',
            'number' => 7,
        ]],
        AlbumSeeder::LOAD => [[
            'name' => 'The House Jack Built',
            'number' => 3,
        ], [
            'name' => 'Cure',
            'number' => 8,
        ], [
            'name' => 'Poor Twisted Me',
            'number' => 9,
        ]],
        AlbumSeeder::MAKE_IT_LOUDER => [[
            'name' => 'Бойцовский клуб',
            'number' => 2,
        ], [
            'name' => 'Бизнес',
            'number' => 3,
        ], [
            'name' => 'Пока не поздно',
            'number' => 4,
        ]],
        AlbumSeeder::TIME_X => [[
            'name' => 'Люди смотрят вверх',
            'number' => 7,
        ], [
            'name' => 'Мама',
            'number' => 9,
        ], [
            'name' => 'Штурмуя небеса',
            'number' => 12,
        ]],
        AlbumSeeder::A_MARVELOUS_NEW_WORLD => [[
            'name' => 'Весна',
            'number' => 2,
        ], [
            'name' => 'Обычный человек',
            'number' => 8,
        ], [
            'name' => 'Тонкая красная нить',
            'number' => 10,
        ]],
    ];

    public function run(): void
    {
        foreach ($this->songs as $albumId => $songs) {
            foreach ($songs as $song) {
                DB::table('songs')->insert([
                    'album_id' => $albumId,
                    'name' => $song['name'],
                    'order_number_in_album' => $song['number'],
                ]);
            }
        }
    }
}
