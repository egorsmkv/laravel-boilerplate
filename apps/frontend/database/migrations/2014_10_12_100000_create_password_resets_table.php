<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
};
