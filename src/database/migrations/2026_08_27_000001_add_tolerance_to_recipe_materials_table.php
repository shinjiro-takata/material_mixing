<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToleranceToRecipeMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipe_materials', function (Blueprint $table) {
            $table->decimal('tolerance', 8, 3)->nullable()->after('quantity')->comment('許容範囲（相対値、±で上下同じ）');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipe_materials', function (Blueprint $table) {
            $table->dropColumn('tolerance');
        });
    }
}
