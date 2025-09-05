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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->string('short_description', 2000)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['slug']);
        });

        Schema::create('category_service_provider', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('service_provider_id');

            $table->primary(['category_id','service_provider_id']);

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')->cascadeOnDelete();
            $table->foreign('service_provider_id')
                ->references('id')
                ->on('service_providers')
                ->cascadeOnDelete();

            $table->index(['category_id','service_provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_providers');

        Schema::dropIfExists('category_service_provider');
    }
};
