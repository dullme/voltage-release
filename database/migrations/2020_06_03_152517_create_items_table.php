<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('item名称');
            $table->unsignedTinyInteger('type')->comment('类型');
            $table->unsignedTinyInteger('pos_neg')->comment('正负极');
            $table->string('color')->nullable()->comment('颜色');
            $table->string('file')->nullable()->comment('文件');
            $table->string('image')->nullable()->comment('图片');
            $table->string('form')->nullable()->comment('特殊格式的文本');
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
        Schema::dropIfExists('items');
    }
}
