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
        Schema::table('jobs', function (Blueprint $table) {
            if (!Schema::hasColumn('jobs', 'title')) {
                $table->string('title');
            }

            if (!Schema::hasColumn('jobs', 'description')) {
                $table->text('description');
            }

            if (!Schema::hasColumn('jobs', 'location')) {
                $table->string('location');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'location']);
        });
    }
};

