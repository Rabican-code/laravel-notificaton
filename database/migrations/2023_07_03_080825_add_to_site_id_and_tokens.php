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
        Schema::table('site_id_and_tokens', function (Blueprint $table) {
            $table->integer('site_id')->default('1')->change();
            $table->longText('token')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_id_and_tokens', function (Blueprint $table) {
            //
        });
    }
};
