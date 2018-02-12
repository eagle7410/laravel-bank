<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->increments('id');

            $table->string('title');

            $table->integer('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_read_support')->default(false);

            $table->timestamp('closed_at')->nullable();

            $table->integer('created_by');
            $table->integer('updated_by');

            $table->timestamps();
        });

        Schema::create('ticket_dialog', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('ticket_id');
            $table->index('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');

            $table->boolean('is_support')->default(false);

            $table->text('text');

            $table->timestamp('created_at')->nullable();
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_dialog');
        Schema::dropIfExists('tickets');
    }
}
