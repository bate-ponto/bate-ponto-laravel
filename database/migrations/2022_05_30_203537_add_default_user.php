<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        User::create([
            'name'      => 'User',
            'email'     => 'user@ponto.com',
            'password'  => Hash::make('password'),
        ]);
    }

    public function down()
    {
        User::where([
            'name'      => 'User',
            'email'     => 'user@ponto.com',
            'password'  => Hash::make('password'),
        ])->delete();
    }
};
