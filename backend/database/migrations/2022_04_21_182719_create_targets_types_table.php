<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets_types', function (Blueprint $table) {
            $table->bigIncrements('targets_types_id');
            $table->unsignedBigInteger('targets_id');
            $table->string('title', 30)->default('default');
            $table->string('contents', 3000)->nullable();
            $table->tinyInteger('accomplished')->default(0);

            $table->foreign('targets_id')
                ->references('targets_id')
                ->on('targets')
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
        Schema::dropIfExists('targets_types');
    }
}
