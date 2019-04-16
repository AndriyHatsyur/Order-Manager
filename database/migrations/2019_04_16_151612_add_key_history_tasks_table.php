<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeyHistoryTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_tasks', function (Blueprint $table) {

            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('task_status_id')->references('id')->on('task_statuses');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_tasks', function (Blueprint $table) {
            //
        });
    }
}
