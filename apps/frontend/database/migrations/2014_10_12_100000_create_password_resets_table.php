<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    public function up(): void
    {
        Schema::create('password_resets', static function (Blueprint $table) {
            $table->string('email')->index()->comment('E-Mail');
            $table->string('token')->comment('Token');
            $table->timestamp('created_at')->nullable()->comment('Created At');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
}
