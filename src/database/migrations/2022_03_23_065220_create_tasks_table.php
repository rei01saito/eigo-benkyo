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
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger('priority');
            $table->foreign('priority')
                ->references('priorities_id')
                ->on('priorities')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title', 30);
            $table->string('contents', 255)->nullable();
            $table->unsignedInteger('n_exec')->nullable();
            $table->unsignedInteger('timer');
            
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
