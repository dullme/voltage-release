<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harnesses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('名称');
            $table->integer('min_length')->comment('最小组串长度');
            $table->integer('max_length')->comment('最大组串长度');
            $table->integer('fuse')->comment('保险丝安培数');
            $table->integer('string')->comment('几串');
            $table->integer('outlet_length')->comment('出线长度');
            $table->integer('module')->comment('组件');
            $table->string('file')->nullable()->comment('文件');
            $table->string('image')->nullable()->comment('图片');
            $table->string('remarks')->nullable()->comment('备注');
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
        Schema::dropIfExists('harnesses');
    }
}
