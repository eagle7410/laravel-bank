<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfiles extends Migration
{
    const TABLE_NAME = \App\Models\Profiles\ProfileBase::TABLE_NAME;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name_first');
            $table->string('name_middle')->nullable();
            $table->string('name_last');
            $table->string('desc')->nullable();
            $table->string('post')->nullable();


            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
