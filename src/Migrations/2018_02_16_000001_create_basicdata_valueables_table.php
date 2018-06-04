<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicdataValueablesTable extends Migration
{

    const table = 'basicdata_valueables';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::table, function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('basicdata_values_id')->nullable()->default(null)->unsigned();
            $table->integer('target_id')->nullable()->default(null)->unsigned();
            $table->string('target_type', 255)->nullable()->default(null);
            $table->string('val', 255)->nullable()->default(null);
            $table->integer('type')->nullable()->default(null)->unsigned();
            $table->enum('is_active', ['0','1'])->default('1');
            $table->integer('created_by')->nullable()->default(null)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::table);
    }

}
