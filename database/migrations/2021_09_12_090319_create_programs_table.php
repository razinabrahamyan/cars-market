<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->unsigned();
            $table->json('residual_values')->nullable();
            $table->json('money_factor')->nullable();
            $table->double('default_money_factor')->nullable();
            $table->json('fees')->nullable();
            $table->json('invoices')->nullable();
            $table->float('default_invoice')->default(95.5);
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
        Schema::dropIfExists('programs');
    }
}
