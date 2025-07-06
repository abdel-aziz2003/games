<?php

use App\Models\Setting;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('tell')->nullable();
            $table->string('logo');
            $table->string('favicon');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('demo')->default('meg-game-portal.onecrib.com');
            $table->string('home_banner');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        $table = new Setting();
        $table->name = 'Mega Game Portal';
        $table->email = 'info@onecrib.com';
        $table->tell = '01222777888';
        $table->logo = 'logo.png';
        $table->favicon = 'favicon.png';
        $table->facebook = '#';
        $table->twitter = '#';
        $table->instagram = '#';
        $table->youtube = '#';
        $table->home_banner = 'banner.jpg';
        $table->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('settings');
    }
};
