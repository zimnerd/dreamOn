<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusAndTypeToDream extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dreams', function (Blueprint $table) {
            //

            $table->unsignedInteger('system_status')->default(null);
            $table->unsignedInteger('dream_type')->default(null);
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dreams', function (Blueprint $table) {
            //
            $table->dropColumn('system_status');
            $table->dropColumn('dream_type');
        });
    }
}
