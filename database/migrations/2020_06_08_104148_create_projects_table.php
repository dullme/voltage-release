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
            $table->integer('company_id')->unsigned()->comment('公司ID');
            $table->string('code')->unique()->comment('项目编号');
            $table->string('name')->unique()->comment('项目名称');
            $table->string('address')->nullable()->comment('项目地址');
            $table->integer('total_quantity')->nullable();
            $table->decimal('size_dc', 10, 3)->nullable();
            $table->string('connector')->nullable();
            $table->integer('fuse')->nullable();
            $table->decimal('junction_box_to_rack_1', 10, 3);
            $table->decimal('junction_box_to_rack_2', 10, 3)->nullable();
            $table->integer('layout_of_whip');
            $table->integer('distance_between_poles')->nullable();
            $table->integer('row_head_to_cbx_1')->nullable();
            $table->integer('module_to_module_extender')->nullable();
            $table->string('end_of_extender');
            $table->text('remarks');
            $table->longText('remark_list')->nullable();
            $table->string('neg_color');
            $table->string('pos_color');
            $table->integer('whip_quote_quantity')->nullable();
            $table->integer('typical_quote_quantity')->nullable();
            $table->integer('whip_buffer')->nullable();
            $table->boolean('whip_to_be_half')->default(false);
            $table->integer('string_length_buffer')->nullable();
            $table->string('specifications');
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
