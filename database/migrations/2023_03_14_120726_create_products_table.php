<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cate_id')->nullable()->comment('產品類型id');
            $table->string('name')->comment('產品名稱');
            $table->text('description')->comment('產品介紹');
            $table->tinyInteger('enabled')->default(1)->comment('狀態');
            $table->string('operator_id')->nullable()->comment('操作人員ID');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};