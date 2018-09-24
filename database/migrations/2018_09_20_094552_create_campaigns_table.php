<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use \App\Models\Reference\CampaignStatus;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('details')->nullable();

            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedInteger('status_id')->default(CampaignStatus::DRAFT);
            $table->foreign('status_id')->references('id')->on('campaign_statuses');

            $table->unsignedInteger('featured_image_id');

            //Make sure two or more campaigns does not point on the same featured_image
            $table->unique('featured_image_id');

            //Cannot add it here cause images table does not exist yet and there is reason for that.
            //$table->foreign('featured_image_id')->references('id')->on('images');

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
        Schema::dropIfExists('campaigns');
    }
}
