<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('tasks_id');
            $table->unsignedBigInteger('targets_id');
            $table->unsignedBigInteger('priority');
            $table->string('title', 30);
            $table->string('contents', 2000)->nullable();
            $table->unsignedInteger('n_exec')->nullable();
            $table->unsignedInteger('timer');
            
            
            $table->foreign('targets_id')
            ->references('targets_id')
            ->on('targets')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('priority')
            ->references('priorities_id')
            ->on('priorities')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('tasks');
    }
}
