<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('component_id');
            $table->unsignedInteger('length')->comment('长度/ft');
            $table->unsignedInteger('quantity')->comment('数量');
            $table->unsignedInteger('tracker')->default(0)->comment('Tracker to tracker');
            $table->unsignedDecimal('multiple', 10, 2)->default(0)->comment('Multiple');
            $table->boolean('driver')->default(0)->comment('有无Driver');

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
        Schema::dropIfExists('item_components');
    }
}
