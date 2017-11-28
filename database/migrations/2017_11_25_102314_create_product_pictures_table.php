<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('order')->unsigned();
            $table->text('origin_name');
            $table->text('origin_abs_fs_path');
            $table->text('origin_http_public_path');
            $table->integer('origin_size')->unsigned();
            $table->string('origin_type');
            $table->text('thumb_name');
            $table->text('thumb_abs_fs_path');
            $table->text('thumb_http_public_path');
            $table->integer('thumb_size')->unsigned();
            $table->string('thumb_type');
            $table->softDeletes();
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
        Schema::dropIfExists('product_pictures');
    }
}
