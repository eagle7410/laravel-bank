<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeposits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_statuses', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('name');
            $table->string('alias');
            $table->text('desc')->nullable();
        });

        Schema::create('deposit_actions', function (Blueprint $table) {
            $table->smallIncrements('id');

            $table->string('name');
            $table->string('alias');
            $table->text('desc')->nullable();
        });

        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->smallInteger('status_id');
            $table->foreign('status_id')->references('id')->on('deposit_statuses');

            $table->double('sum', 20, 3);
            $table->double('percent', 5, 2);
            $table->string('number')->unique();

            $table->timestamp('start_at');
            $table->timestamp('income_at');
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by');
        });

        Schema::create('deposit_history', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('deposit_id');
            $table->index('deposit_id');
            $table->foreign('deposit_id')->references('id')->on('deposits')->onDelete('cascade');

            $table->smallInteger('deposit_action_id');
            $table->foreign('deposit_action_id')->references('id')->on('deposit_actions');

            $table->double('sum_before', 20, 3)->default(0);
            $table->double('sum_after', 20, 3);

            $table->timestamp('created_at')->nullable();
            $table->integer('created_by');
            $table->text('comment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit_history');
        Schema::dropIfExists('deposit_actions');
        Schema::dropIfExists('deposits');
        Schema::dropIfExists('deposit_statuses');
    }
}
