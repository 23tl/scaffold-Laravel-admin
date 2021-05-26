<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('名称');
            $table->string('url')->nullable()->comment('链接');
            $table->tinyInteger('type')->default(\App\Models\Banner::TYPE_INDEX)->comment('类型');
            $table->tinyInteger('urlType')->default(\App\Models\Banner::URL_WEB)->comment('跳转类型');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('image')->comment('图片');
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('deletedTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
