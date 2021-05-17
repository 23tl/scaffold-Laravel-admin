<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->integer('parentId')->default(0);
            $table->string('name');
            $table->tinyInteger('type')->default(\App\Models\Tag::TYPE_GOODS);
            $table->integer('createdTime');
            $table->integer('updatedTime');
            $table->integer('deletedTime')->nullable();

            $table->index('name', 'idx_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
