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
        Schema::create('mprs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained();
            $table->integer('version_nbr')->default(1);
            $table->boolean('can_edit')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mprs');
    }
};
