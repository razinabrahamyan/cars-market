<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vins', function (Blueprint $table) {
            $table->id();
            $table->string('vin', 17)->unique('vin_index')->comment('Vehicle VIN nubmer');
            $table->integer('msrp')->comment('Vehicle MSRP');
            $table->string('brand')->comment('Vehicle Brand');
            $table->string('model')->comment('Vehicle model');
            $table->string('clear_model')->nullable()->comment('Cleared Vehicle model');
            $table->smallInteger('year')->comment('Vehicle make year');
            $table->json('options')->comment('Vehicle additional details');
            $table->boolean('program_checked')->default(false);
            $table->boolean('is_api')->default(false);
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
        Schema::dropIfExists('vins');
    }
}
