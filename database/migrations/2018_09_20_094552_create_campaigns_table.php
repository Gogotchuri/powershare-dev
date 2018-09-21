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
