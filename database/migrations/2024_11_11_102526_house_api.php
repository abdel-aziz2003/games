<?php

use App\Models\Api;
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
        $table = new Api();
        $table->name = env('APP_NAME');
        $table->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
