<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_data', function (Blueprint $table) {
            $table->id();
            $table->integer('object_id')->nullable();

            $table->foreignId('category_id');

            $table->double('x')->nullable();
            $table->double('y')->nullable();

            $table->string('carrier_sponsor', 255)->nullable();
            $table->string('services', 255)->nullable();
            $table->string('designation', 255)->nullable();
            $table->string('short_designation', 100)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('street_code', 50)->nullable();
            $table->string('house_designation', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('city_town', 100)->nullable();
            $table->string('after_school_care', 255)->nullable();
            $table->string('daycare', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('telephone', 100)->nullable();
            $table->string('fax', 100)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('type', 100)->nullable();
            $table->string('kind', 100)->nullable();
            $table->string('location_type', 100)->nullable();
            $table->string('additional_designation', 255)->nullable();
            $table->string('profile', 255)->nullable();
            $table->string('languages', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('carrier_sponsor_type', 100)->nullable();
            $table->string('reference_number', 100)->nullable();
            $table->string('area_type_number', 100)->nullable();
            $table->string('s_number', 100)->nullable();
            $table->string('number', 100)->nullable();
            $table->string('global_id', 255)->nullable();
            $table->string('creation_date')->nullable();
            $table->string('creator', 255)->nullable();
            $table->string('edit_date')->nullable();
            $table->string('editor', 255)->nullable();
            $table->string('accessible', 10)->nullable();
            $table->string('integrative', 10)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_data');
    }
}
