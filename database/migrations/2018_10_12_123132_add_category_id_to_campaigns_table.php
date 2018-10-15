<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {

            //TODO: Should we keep this as nullable?
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('campaign_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('campaigns_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
