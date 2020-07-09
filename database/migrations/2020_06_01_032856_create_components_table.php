<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('零件名称');
            $table->unsignedTinyInteger('part_type')->comment('零件类型');
            $table->integer('line_number')->unsigned()->comment('线号');
            $table->decimal('price', 10, 2)->unsigned()->comment('单价/rmb');
            $table->decimal('weight', 10, 3)->unsigned()->comment('重量/kg');
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
        Schema::dropIfExists('components');
    }
}
