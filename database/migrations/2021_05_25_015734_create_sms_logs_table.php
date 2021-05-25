<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('userId')->nullable();
            $table->string('mobile');
            $table->json('params')->nullable()->comment('参数');
            $table->text('content')->nullable()->comment('内容');
            $table->integer('scenes')->nullable()->comment('场景值');
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('deletedTime')->nullable();

            $table->index(['mobile', 'scenes'], 'idx_mobile_scenes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_logs');
    }
}
