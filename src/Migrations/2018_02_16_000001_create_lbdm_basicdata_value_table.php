<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLbdmBasicdataValueTable extends Migration
{

    private $table = 'lbdm_basicdata_values';

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
            $table->integer('basicdata_id')->nullable()->default(0)->unsigned();
            $table->string('title',255)->nullable()->default(null);
            $table->string('dev_title',255)->nullable()->default(null);
            $table->text('value')->nullable()->default(null);
            $table->string('op_type',255)->nullable()->default(null);
            $table->string('comment',255)->nullable()->default(null);
            $table->string('validation',255)->nullable()->default(null);
            $table->string('extra_field',255)->nullable()->default(null);
            $table->enum('undeletable', array('0','1'))->nullable()->default('0');
            $table->string('dev_comment',255)->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->enum('is_active',['0','1'])->nullable()->default('1');
            $table->integer('created_by')->nullable()->default(null)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE lbdm_basicdata_values ADD unique_md5_dev_title CHAR (32) AS (MD5(CONCAT_WS('X',dev_title,basicdata_id,deleted_at))) PERSISTENT UNIQUE");
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
