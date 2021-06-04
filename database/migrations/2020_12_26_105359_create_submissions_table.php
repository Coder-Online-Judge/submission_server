<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('token')->nullable();
            $table->foreignId('language_id');
            $table->text('source_code');
            
            $table->enum('checker_type', ['default','custom'])->default('default');
            $table->string('default_checker')->nullable();
            $table->text('custom_checker')->nullable();

            $table->text('input')->nullable();
            $table->text('output')->nullable();
            $table->text('expected_output')->nullable();
            $table->integer('time_limit');
            $table->integer('memory_limit')->default(0);
            $table->foreignId('verdict_id')->default(0);
            $table->integer('time')->default(0);
            $table->integer('memory')->default(0);
            
            $table->text('checker_log')->nullable();
            $table->text('compiler_log')->nullable();

            $table->timestamps();

            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('verdict_id')->references('id')->on('verdicts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
