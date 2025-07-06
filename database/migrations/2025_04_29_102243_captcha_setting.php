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
        Schema::table('settings', function(Blueprint $table){
$table->string('g_site_key')->nullable();
$table->string('g_secret_key')->nullable();
$table->text('address')->nullable();
        });

        $table = Setting::find(1);
        $table->address = '#129 New City Road. Wescon County';
        $table->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function(Blueprint $table){
$table->dropColumn(['g_site_key','g_secret_key','address']);
        });
    }
};
