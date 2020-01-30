<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTaggableId extends Migration
{
    public function up()
    {
        Schema::table('taggables', function (Blueprint $table) {
            $table->integer('taggable_id')->nullable()->change();
        });
    }

    public function down()
    {

    }
}

