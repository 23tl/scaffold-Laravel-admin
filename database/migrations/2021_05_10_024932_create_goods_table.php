<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default()->comment('类型');
            $table->integer('categoryId');
            $table->string('name');
            $table->string('subtitle')->nullable()->comment('副标题');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('originalPrice')->default(0)->comment('原价');
            $table->integer('costPrice')->default(0)->comment('成本价');
            $table->integer('vipPrice')->default(0)->comment('会员价');
            $table->tinyInteger('integralSwitch')->default(\App\Models\BaseModel::STATUS_ERROR)->comment('是否开启积分');
            $table->integer('integral')->default(0)->comment('积分');
            $table->integer('shipping')->default(0)->comment('运费');
            $table->json('cover')->comment('产品轮播图');
            $table->text('content')->comment('内容');
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
        Schema::dropIfExists('goods');
    }
}
