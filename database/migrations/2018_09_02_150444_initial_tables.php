<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unlocked')->default(0);
            $table->unsignedInteger('redeemable')->default(0);
            $table->unsignedInteger('redeemed')->default(0);
            $table->unsignedInteger('completed')->default(0);
            $table->unsignedInteger('completable')->default(0);
            $table->unsignedInteger('should_upload_finished')->default(0);
            $table->unsignedInteger('show_uploaded_as_thumb')->default(0);
            $table->longText('complete_redeem_label')->nullable();
            $table->longText('complete_redeem_results')->nullable();
            $table->string('series');
            $table->string('title');
            $table->string('keyword');
            $table->string('description')->nullable();
            $table->string('image_path')->nullable();
            $table->longText('uploaded_image')->nullable();
            $table->longText('finished_image')->nullable();
            $table->timestamp('unlocked_at')->nullable();
            $table->timestamp('redeemed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('card_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('card_id');
            $table->string('file_path');
            $table->timestamps();
        });

        Schema::create('card_scan_log', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('results')->nullable();
            $table->timestamps();
        });

        Schema::create('jail_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('has_get_out_card')->default(0);
            $table->unsignedInteger('used_get_out_card')->default(0);
            $table->timestamp('in_jail_at')->nullable();
            $table->timestamp('out_of_jail_at')->nullable();
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
        //
    }
}
