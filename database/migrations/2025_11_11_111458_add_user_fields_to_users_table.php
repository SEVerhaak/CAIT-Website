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
        Schema::table('users', function (Blueprint $table) {
            // Add your custom fields
            $table->string('f_name')->nullable()->after('id');
            $table->string('m_name')->nullable()->after('f_name');
            $table->string('l_name')->nullable()->after('m_name');
            $table->bigInteger('student_id')->nullable()->after('l_name');
            $table->string('role')->default('user')->after('student_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['f_name', 'm_name', 'l_name', 'student_id', 'role']);
        });
    }
};
