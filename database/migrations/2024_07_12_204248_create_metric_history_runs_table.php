<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('metric_history_runs', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('accesibility_metric');
            $table->integer('pwa_metric');
            $table->integer('performance_metric');
            $table->integer('seo_metric');
            $table->integer('best_practices_metric');
            $table->unsignedBigInteger('strategy_id');
            $table->timestamps();

            $table->foreign('strategy_id')->references('id')->on('strategies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metric_history_runs');
    }
};
