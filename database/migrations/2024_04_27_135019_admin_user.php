<?php

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(2);
        });

        $table = new User();
        $table->name = 'Admin';
        $table->email = 'admin@admin.com';
        $table->email_verified_at = date('Y-m-d H:i:s', time());
        $table->password = Hash::make('admin');
        $table->role = 1;
        $table->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
