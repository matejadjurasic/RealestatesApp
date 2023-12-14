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
         
        Schema::table('favorite_profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
 
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('realestate_id');
 
            $table->foreign('realestate_id')->references('id')->on('real_estates');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('favorite_profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['realestate_id']);

            $table->dropColumn('user_id');
            $table->dropColumn('realestate_id');
        });
    }
};
