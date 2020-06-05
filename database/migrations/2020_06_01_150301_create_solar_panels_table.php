<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolarPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solar_panels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('太阳能板名称');
            $table->unsignedTinyInteger('placement_method')->comment('摆放方式');
            $table->unsignedInteger('length')->comment('长');
            $table->unsignedInteger('width')->comment('宽');
            $table->unsignedInteger('m_l_pos')->comment('正极模块引线');
            $table->unsignedInteger('m_l_neg')->comment('负极模块引线');
            $table->string('file')->nullable()->comment('文件');
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
        Schema::dropIfExists('solar_panels');
    }
}
