<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('pId')->default(0)->comment('父级ID');
            $table->string('title');
            $table->string('icon')->nullable()->comment('图标');
            $table->string('href')->nullable()->comment('链接;此链接作为权限效验使用');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('target')->default('_self')->comment('打开方式');
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
        Schema::dropIfExists('menus');
    }
}
