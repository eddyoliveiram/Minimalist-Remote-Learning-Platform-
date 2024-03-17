<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->integer('position')->nullable();
            $table->string('type');
            $table->string('local');
            $table->text('text_typed')->nullable();
            $table->string('file_uploaded')->nullable();
            $table->string('external_file_url')->nullable();
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
