<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('vulnerability_id');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->foreign('vulnerability_id')
                  ->references('id')
                  ->on('vulnerabilities')
                  ->onDelete('cascade');

            $table->unique(['user_id', 'vulnerability_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};
