<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->index('username');
        });

        Schema::table('real_estates', function (Blueprint $table) {
            $table->index('follows_count')->where('follows_count', '>', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->dropIndex(['username']);
            $table->dropIndex(['follows_count']);
        });
    }
};
