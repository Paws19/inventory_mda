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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('item_name');
            $table->enum('condition', ['Working', 'Defective', 'For_Repair'])->default('Working');
            $table->enum('status', ['Available', 'In_use', 'Borrowed'])->default('Available');
            $table->string('assigned_to');
            $table->string('location');
            $table->date('purchase_date');
            $table->date('warranty_expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
