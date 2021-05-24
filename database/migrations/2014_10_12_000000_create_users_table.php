<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('invite')->nullable()->comment('邀请码');
            $table->integer('parentId')->default(0)->comment('上级用户');
            $table->string('path')->nullable()->comment('节点路径');
            $table->string('name');
            $table->string('mobile');
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->integer('availableBalance')->default(0)->comment('可用余额');
            $table->integer('electronicBalance')->default(0)->comment('电子币');
            $table->integer('integral')->default(0)->comment('积分');
            $table->integer('freezeBalance')->default(0)->comment('冻结');
            $table->tinyInteger('status')->default(\App\Models\BaseModel::STATUS_SUCCESS)->comment('状态');
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('deletedTime')->nullable();

            $table->index('parentId', 'idx_parentId');
            $table->index('name', 'idx_name');
            $table->index('mobile', 'idx_mobile');
            $table->index('invite', 'idx_invite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
