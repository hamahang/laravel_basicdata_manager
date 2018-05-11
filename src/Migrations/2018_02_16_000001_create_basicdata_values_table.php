<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicdataValuesTable extends Migration
{

    const table = 'basicdata_values';

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
            $table->integer('basicdata_id')->default(0)->unsigned();
            $table->string('title', 255)->nullable()->default(null);
            $table->string('dev_title', 255)->nullable()->default(null);
            $table->text('value')->nullable()->default(null);
            $table->integer('op_type')->default(0);
             $table->string('comment', 255)->nullable()->default(null);
             $table->string('validation', 255)->nullable()->default(null);
            $table->string('dev_comment', 255)->nullable()->default(null);
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
