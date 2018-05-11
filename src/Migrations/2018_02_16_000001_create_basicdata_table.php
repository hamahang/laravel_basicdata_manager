<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicdataTable extends Migration
{

    const table = 'basicdata';

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
            $table->integer('parent_id')->nullable()->default(null)->unsighned();
            $table->string('title', 255)->nullable()->default(null);
            $table->string('dev_title', 255)->nullable()->default(null);
            $table->string('comment', 255)->nullable()->default(null);
            $table->string('dev_comment', 255)->nullable()->default(null);
            $table->enum('is_active', ['0','1'])->default('1');
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index('dev_title', 'dev_title', 'BTREE');
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
