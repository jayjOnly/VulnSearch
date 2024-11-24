<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('vulnerabilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('cve_id')->unique();
            $table->text('description');
            $table->string('severity');
            $table->decimal('cvss_score', 3, 1);
            $table->string('source');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vulnerabilities');
    }
};
