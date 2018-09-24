<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('campaign_id')->nullable();
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');

            $table->string('name');
            $table->string('url');
            $table->timestamps();

            //TODO: Add foreign key constraint to campaigns, once images table is created
            //Add foreign key constraint to campaigns referencing images table
            /*\Illuminate\Support\Facades\DB::statement(
                'ALTER TABLE campaigns ADD FOREIGN KEY (featured_image_id) REFERENCES images(id)'
            );*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //TODO: Remove foreign key constraint from campaigns, before images table is dropped
        Schema::dropIfExists('images');
    }
}
