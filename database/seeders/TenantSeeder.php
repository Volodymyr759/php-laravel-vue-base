<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     *
     * @return void
     */
    public function run()
    {
        $tenants = [
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1111'],
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1112'],
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1113'],
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1114'],
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1115'],
            ['first_name' => 'John_' . Str::random(5), 'last_name' => 'Snow_' . Str::random(5), 'email' => 'john_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1116'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1117'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1118'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1119'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1110'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1120'],
            ['first_name' => 'Jack_' . Str::random(5), 'last_name' => 'Black_' . Str::random(5), 'email' => 'jack_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1121'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1122'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1123'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1124'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1125'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1126'],
            ['first_name' => 'Jane_' . Str::random(5), 'last_name' => 'Dane_' . Str::random(5), 'email' => 'jane_' . Str::random(5).'@gmail.com', 'phone' => '+38 067 111 1127'],
        ];

        DB::table('tenants')->delete();

        DB::table('tenants')->insert($tenants);
    }
}
