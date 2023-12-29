<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('name')->comment('Name');
            $table->string('email')->unique()->comment('E-Mail');
            $table->timestamp('email_verified_at')->nullable()->comment('When E-mail was verified');
            $table->string('password')->comment('Password Hash');
            $table->string('remember_token', 100)->nullable()->comment('Remember Token');
            $table->timestamp('created_at')->nullable()->comment('Created At');
            $table->timestamp('updated_at')->nullable()->comment('Updated At');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
