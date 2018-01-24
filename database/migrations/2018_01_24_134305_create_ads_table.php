<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->string('id');
            $table->string('account_id');
            $table->string('campaign_id');
            $table->char('status');
            $table->char('approved');
            $table->string('create_time');
            $table->string('update_time');
            $table->string('day_limit');
            $table->string('all_limit');
            $table->string('start_time');
            $table->string('stop_time');
            $table->string('category1_id');
            $table->string('category2_id');
            $table->string('age_restriction');
            $table->string('name');
            $table->string('cost_type');
            $table->string('ad_format');
            $table->string('cpm');
            $table->string('impressions_limited');
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
        Schema::dropIfExists('ads');
    }
}
