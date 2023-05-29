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
        Schema::table('listings', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('by_user_id')->nullable();
            $table->foreign('by_user_id')->references('id')->on('users');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            //
            $table->dropForeign('listings_by_user_id_foreign');
            $table->dropColumn('by_user_id');
        });
    }
};
