<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['name' => 'Mentor', 'slug' => 'mentor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mentee', 'slug' => 'mentee', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Add role_id column to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('password')->nullable()->constrained('roles');
        });

        // Migrate existing role data
        $mentorRole = DB::table('roles')->where('slug', 'mentor')->first();
        $menteeRole = DB::table('roles')->where('slug', 'mentee')->first();

        // Update existing users with role_id based on their current role
        DB::table('users')->where('role', 'mentor')->update(['role_id' => $mentorRole->id]);
        DB::table('users')->where('role', 'mentee')->update(['role_id' => $menteeRole->id]);

        // Drop the old role column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    public function down(): void
    {
        // Add back the role column
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password');
        });

        // Migrate data back
        $mentorRole = DB::table('roles')->where('slug', 'mentor')->first();
        $menteeRole = DB::table('roles')->where('slug', 'mentee')->first();

        DB::table('users')->where('role_id', $mentorRole->id)->update(['role' => 'mentor']);
        DB::table('users')->where('role_id', $menteeRole->id)->update(['role' => 'mentee']);

        // Drop the role_id column and foreign key
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });

        Schema::dropIfExists('roles');
    }
}; 