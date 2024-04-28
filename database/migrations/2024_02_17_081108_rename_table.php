
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Renames Table
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('student', 'students');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('students', 'student');
    }
};



