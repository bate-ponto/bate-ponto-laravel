<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class () extends Migration {
    public function up(): void
    {
        User::create([
            'name'     => 'User',
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }

    public function down()
    {
        User::where([
            'name'     => 'User',
            'email'    => 'admin@admin.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ])->delete();
    }
};
