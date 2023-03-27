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
        Schema::table('cates', function ($table) {
            $table->unsignedBigInteger('operator_id')->nullable()->comment('操作人員ID')->change();
        });
        Schema::table('products', function ($table) {
            $table->unsignedBigInteger('operator_id')->nullable()->comment('操作人員ID')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('products', function ($table) {
            $table->string('operator_id')->nullable()->comment('操作人員ID')->change();
        });
        Schema::table('cates', function ($table) {
            $table->string('operator_id')->nullable()->comment('操作人員ID')->change();
        });
    }
};