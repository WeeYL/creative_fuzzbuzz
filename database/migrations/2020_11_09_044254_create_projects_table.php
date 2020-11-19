<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id');
            $table->string('category')->nullable();
            $table->string('status')->nullable();


            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('image')->nullable();
            $table->integer('goal')->nullable();

            $table->index('profile_id') ;

            $table->dateTime('expired_at')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
