<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 50)->change();
            //https://laravel.com/docs/master/migrations#modifying-columns
            $table->dropColumn('name');
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->dropColumn('email_verified_at');
            $table->dropColumn('password');
            $table->string('phone', 12);
            //https://laravel.com/docs/master/migrations#modifying-columns
            $table->dropRememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
