<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToComponentsAndStorages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->unsigned()->default('1');
        });

        Schema::table('storage', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->unsigned()->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('storage', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
