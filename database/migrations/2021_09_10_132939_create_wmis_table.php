<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wmis', function (Blueprint $table) {
            $table->id();
            $table->string('wmi')->index('wmi_index')->comment('WMI from vin number');
            $table->string('brand_id')->index('brand_index')->comment('Car Brand');
            $table->string('country')->index('country_index')->comment('Сountry of manufacture');
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
        Schema::dropIfExists('wmis');
    }
}
