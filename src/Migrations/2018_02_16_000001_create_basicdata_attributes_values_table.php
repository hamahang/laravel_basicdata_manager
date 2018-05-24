<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicdataAttributesValuesTable extends Migration
{

    const table = 'basicdata_attributes_values';

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
            $table->integer('basicdata_value_id')->unsighned()->default(0);
            $table->integer('basicdata_attribute_id')->unsighned()->default(0);
            $table->text('value')->nullable()->default(null);
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
