<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->tinyInteger('currency')->default(\App\Models\FundLogs::FUND_TYPE_AVAILABLE)->comment('币种');
            $table->tinyInteger('type')->default(\App\Models\FundLogs::TYPE_ADD)->comment('类型');
            $table->tinyInteger('group')->default(\App\Models\FundLogs::GROUP_CZ)->comment('资金类型');
            $table->integer('amount')->default(0)->comment('变动金额');
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('releaseTime')->nullable()->comment('释放时间');
            $table->integer('deletedTime')->nullable();

            $table->index(['userId', 'currency', 'type', 'group'], 'idx_u_c_t_g');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_logs');
    }
}
