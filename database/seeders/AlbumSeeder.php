<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    const SLIPKNOT = 1;
    const IOWA = 2;
    const ALL_HOPE_IS_GONE = 3;

    const HERZELEID = 4;
    const SEHNSUCTH = 5;
    const MUTTER = 6;

    const WITHOUT_PRESERVATIVES = 7;
    const THREE_WAYS = 8;
    const LIBERTY = 9;

    const RIDE_THE_LIGHTNING = 10;
    const MASTER_OF_PUPPETS = 11;
    const LOAD = 12;

    const MAKE_IT_LOUDER = 13;
    const TIME_X = 14;
    const A_MARVELOUS_NEW_WORLD = 15;

    private array $albums = [
        ExecutorSeeder::COREY_TAYLOR => [
            self::SLIPKNOT => [
                'name' => 'Slipknot',
                'year' => 1999,
            ],
            self::IOWA => [
                'name' => 'Iowa',
                'year' => 2001,
            ],
            self::ALL_HOPE_IS_GONE => [

                'name' => 'All Hope Is Gone',
                'year' => 2008,
            ]
        ],
        ExecutorSeeder::TILL_LINDEMANN => [
            self::HERZELEID => [
                'name' => 'Herzeleid',
                'year' => 1995,
            ],
            self::SEHNSUCTH => [
                'name' => 'Sehnsucht',
                'year' => 1997,
            ],
            self::MUTTER => [
                'name' => 'Mutter',
                'year' => 2001,
            ]],
        ExecutorSeeder::RUSTEM_BULATOV => [
            self::WITHOUT_PRESERVATIVES => [
                'name' => 'Без консервантов',
                'year' => 2003,
            ],
            self::THREE_WAYS => [
                'name' => 'Три пути',
                'year' => 2004
            ],
            self::LIBERTY => [
                'name' => 'Свобода',
                'year' => 2005,
            ]],
        ExecutorSeeder::JAMES_HETFIELD => [
            self::RIDE_THE_LIGHTNING => [
                'name' => 'Ride the Lightning',
                'year' => 1984,
            ], self::MASTER_OF_PUPPETS => [
                'name' => 'Master of Puppets',
                'year' => 1986
            ], self::LOAD => [
                'name' => 'Load',
                'year' => 1996,
            ]],
        ExecutorSeeder::LUSINE_GEVORKYAN => [
            self::MAKE_IT_LOUDER => [
                'name' => 'Сделай громче!',
                'year' => 2010,
            ], self::TIME_X => [
                'name' => 'Время X',
                'year' => 2012
            ], self::A_MARVELOUS_NEW_WORLD => [
                'name' => 'Дивный новый мир',
                'year' => 2016,
            ]],
    ];

    public function run(): void
    {
        foreach ($this->albums as $executorId => $album) {
            foreach ($album as $albumId => $albumInfo) {
                DB::table('albums')->insert([
                    'id' => $albumId,
                    'executor_id' => $executorId,
                    'name' => $albumInfo['name'],
                    'year_of_issue' => $albumInfo['year'],
                ]);
            }
        }
    }
}
