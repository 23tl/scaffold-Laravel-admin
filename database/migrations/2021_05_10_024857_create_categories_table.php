<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parentId')->default(0);
            $table->string('name');
            $table->tinyInteger('type')->default(\App\Models\Category::TYPE_NEWS)->comment('类别');
            $table->string('image')->nullable()->comment('封面图');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('url')->nullable()->comment('链接');
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('deletedTime')->nullable();

            $table->index('type', 'idx_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
