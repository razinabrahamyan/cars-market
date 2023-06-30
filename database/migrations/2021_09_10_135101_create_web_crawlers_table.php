<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebCrawlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_crawlers', function (Blueprint $table) {
            $table->id();
            $table->text('url')->comment('URL For Crawling');
            $table->integer('priority')->default(0)->comment('URL with higher priority will be parsed first');
            $table->json('brands')->nullable()->comment('URL for a specific brand');
            $table->json('regexp')->comment('RegExps for WebSite Crawling');
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
        Schema::dropIfExists('web_crawlers');
    }
}
