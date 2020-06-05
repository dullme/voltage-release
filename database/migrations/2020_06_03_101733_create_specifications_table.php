<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solar_panel_id')->comment('太阳能板种类');
            $table->unsignedBigInteger('bracket_id')->comment('支架种类');
            $table->string('name')->unique()->comment('产品型号名称');
            $table->string('show_name')->nullable()->comment('显示名');
            $table->unsignedInteger('quantity')->comment('每个组串的板子数量');
            $table->unsignedTinyInteger('connection_method')->comment('连接方式');
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
        Schema::dropIfExists('specifications');
    }
}
