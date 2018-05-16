<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicdataTable extends Migration
{

    private $table = 'basicdata';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->nullable()->default(null)->unsigned();
            $table->string('title',255)->nullable()->default(null);
            $table->string('dev_title',255)->nullable()->default(null);
            $table->string('comment',255)->nullable()->default(null);
            $table->string('dev_comment',255)->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->string('extra_field',255)->nullable()->default(null);
            $table->integer('created_by')->nullable()->default(null)->unsigned();
            $table->enum('is_active',['0','1'])->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        //\DB::unprepared(file_get_contents(__DIR__.'/sql/customer_tokens.sql') );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }

}
