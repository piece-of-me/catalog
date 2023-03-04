<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExecutorSeeder extends Seeder
{
    const COREY_TAYLOR = 1;
    const TILL_LINDEMANN = 2;
    const RUSTEM_BULATOV = 3;
    const JAMES_HETFIELD = 4;
    const LUSINE_GEVORKYAN = 5;

    private array $executors = [
        self::COREY_TAYLOR => 'Corey Taylor',
        self::TILL_LINDEMANN => 'Till Lindemann',
        self::RUSTEM_BULATOV => 'Rustem Bulatov',
        self::JAMES_HETFIELD => 'James Hetfield',
        self::LUSINE_GEVORKYAN => 'Lusine Gevorkyan',
    ];

    public function run(): void
    {
        foreach ($this->executors as $id => $executor) {
            DB::table('executors')->insert([
                'id' => $id,
                'name' => $executor,
            ]);
        }
    }
}
