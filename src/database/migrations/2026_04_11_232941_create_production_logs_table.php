<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained(); // どのカテゴリか
            $table->foreignId('recipe_id')->constrained(); // どのレシピか
            $table->double('actual_weight'); // 実際の重さ
            $table->double('target_weight'); // 目標の重さ
            $table->unsignedBigInteger('created_by'); // 作成者ID
            $table->foreign('created_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('production_logs');
    }
}
