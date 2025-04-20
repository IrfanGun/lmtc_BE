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
            $table->foreignId('state_id')
                ->nullable()
                ->constrained('states', 'id')
                ->cascadeOnDelete('set null')
                ->after('id');
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles', 'id')
                ->cascadeOnDelete('set null')
                ->after('state_id');
            $table->foreignId('purchase_id')
                ->nullable()
                ->constrained('purchases', 'id')
                ->cascadeOnDelete('set null')
                ->after('role_id');
            $table->foreignId('activation_id')
                ->nullable()
                ->constrained('activations', 'id')
                ->cascadeOnDelete('set null')
                ->after('purchase_id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
