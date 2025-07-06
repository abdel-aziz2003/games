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
        Schema::dropColumns('categories', 'pix');

        Schema::create('apis', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->bigInteger('games')->default(0);
            $table->bigInteger('page')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('games', function(Blueprint $table){
            $table->id();
            $table->bigInteger('game_id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->text('instructions')->nullable();
            $table->text('url');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tags')->nullable();
            $table->text('thumb')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->foreignId('api_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
