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
        Schema::table('student_table', function (Blueprint $table) {
            schema::drop("students");
            schema::dropIfExists("students");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_table', function (Blueprint $table) {
        // If you want to rollback the drop operation
        // You can recreate the table in the down method
        // For example:
        // Schema::create('table_name_to_drop', function (Blueprint $table) {
        //     // Define table schema here
        // });
        });
    }
};
