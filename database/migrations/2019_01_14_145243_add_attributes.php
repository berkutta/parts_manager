<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Component;

class AddAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('components', function (Blueprint $table) {
            $table->schemalessAttributes('extra_attributes');
        });

        $entries = Component::all();

        foreach($entries as $entry) {
            (empty($entry->datasheet) ? : $entry->extra_attributes->datasheet = $entry->datasheet);
            (empty($entry->subcategory) ? : $entry->extra_attributes->subcategory = $entry->subcategory);
            (empty($entry->package) ? : $entry->extra_attributes->package = $entry->package);
            (empty($entry->supplier) ? : $entry->extra_attributes->supplier = $entry->supplier);

            $entry->save();
        }

        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('datasheet');
            $table->dropColumn('subcategory');
            $table->dropColumn('package');
            $table->dropColumn('supplier');
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
            $table->string('datasheet')->nullable();
            $table->string('subcategory')->nullable();
            $table->string('package')->nullable();
            $table->string('supplier')->nullable();
        });

        $entries = Component::all();

        foreach($entries as $entry) {
            $entry->datasheet = $entry->extra_attributes->datasheet;
            $entry->subcategory = $entry->extra_attributes->subcategory;
            $entry->package = $entry->extra_attributes->package;
            $entry->supplier = $entry->extra_attributes->supplier;

            unset($entry->extra_attributes->datasheet);
            unset($entry->extra_attributes->subcategory);
            unset($entry->extra_attributes->package);
            unset($entry->extra_attributes->supplier);

            $entry->save();
        }

        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn('extra_attributes');
        });
    }
}
