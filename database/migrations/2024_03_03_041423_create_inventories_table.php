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
        Schema::create('inventories', function (Blueprint $table) {
            $table->uuid('id')
                ->primary();
            $table->foreignUuid('created_by')
                ->nullable()
                ->constrained('users');
            $table->string('code')
                ->nullable()
                ->unique();
            $table->string('name')
                ->nullable();
            $table->foreignUuid('category_id')
                ->nullable()
                ->constrained('categories');
            $table->text('description')
                ->nullable();
            $table->text('spesification')
                ->nullable();
            $table->text('origin_of_acquisition')
                ->nullable()
                ->comment('asal perolehan');
            $table->foreignUuid('building_id')
                ->nullable()
                ->constrained('buildings');
            $table->foreignUuid('room_id')
                ->nullable()
                ->constrained('rooms');
            $table->string('series_number')
                ->nullable()
                ->comment('nomor seri');
            $table->string('brand')
                ->nullable()
                ->comment('merek');
            $table->string('type')
                ->nullable();
            $table->string('color')
                ->nullable();
            $table->unsignedInteger('quantity')
                ->default(0);
            $table->unsignedSmallInteger('procurement_year')
                ->nullable()
                ->comment('tahun pengadaan');
            $table->unsignedDecimal('price', 20, 2)
                ->nullable()
                ->comment('harga satuan');
            $table->dateTime('registration_date')->nullable();
            $table->text('photo')->nullable();
            $table->string('status')
                ->nullable()
                ->comment('status barang di pinjam atau tidak (but make sure to use this or use the status from the transaction table)');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
