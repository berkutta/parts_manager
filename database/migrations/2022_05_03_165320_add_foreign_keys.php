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
        Schema::table('components', function (Blueprint $table) {        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('storage_id')->references('id')->on('storage');
        });

        Schema::table('storage', function (Blueprint $table) {        
            $table->foreign('user_id')->references('id')->on('users');
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
            $table->dropForeign('components_user_id_foreign');
            $table->dropForeign('components_storage_id_foreign');
        });

        Schema::table('storage', function (Blueprint $table) {        
            $table->dropForeign('storage_user_id_foreign');
        });
    }
};
