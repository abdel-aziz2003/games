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
        Schema::table('settings', function(Blueprint $table){
$table->string('template_ad')->nullable();
$table->string('template_ad_link')->nullable();
$table->string('game_ad')->nullable();
$table->string('game_ad_link')->nullable();
$table->string('play_ad')->nullable();
$table->string('play_ad_link')->nullable();
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
