<?php
// database/migrations/2024_01_14_000001_create_rooms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('size');
            $table->string('bed_type');
            $table->integer('max_occupancy');
            $table->string('special_feature');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['available', 'occupied', 'maintenance']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
