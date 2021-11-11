<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            //$table->string('dob')->nullable()->change();
            $table->string('num_ques', 50)->nullable();
            $table->string('qu_an')->nullable();
            $table->string('an_user', 5)->nullable();
            $table->string('right', 5)->nullable();
            $table->string('str_user', 100)->nullable();
            $table->string('str_right', 100)->nullable();
            $table->string('pict', 50)->nullable();


            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            //$table->dropColumn('dob');
            $table->dropColumn('num_ques');
            $table->dropColumn('qu_an');
            $table->dropColumn('an_user');
            $table->dropColumn('right');
            $table->dropColumn('str_user');
            $table->dropColumn('str_right');
            $table->dropColumn('pict');




            //
        });
    }
}
