<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('cates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('分類名稱');
            $table->tinyInteger('enabled')->default(1)->comment('狀態');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('operator_id')->nullable()->comment('操作人員ID');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('cates');
    }
};