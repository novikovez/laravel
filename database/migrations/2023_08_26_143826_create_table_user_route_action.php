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
        Schema::create('user_route_action', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE']);
            $table->string('route');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_user_route_action');
    }
};
