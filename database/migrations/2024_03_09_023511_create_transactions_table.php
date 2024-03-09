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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users');
            $table->foreignUuid('inventory_id')
                ->nullable()
                ->comment('inventaris yang dipinjam')
                ->constrained('inventories');
            $table->foreignUuid('room_id')
                ->nullable()
                ->constrained('rooms');
            $table->date('date')
                ->nullable()
                ->comment('tanggal transaksi');
            $table->unsignedInteger('quantity')
                ->default(0);
            $table->string('type')
                ->nullable()
                ->comment('tipe transaksi');
            $table->string('note')
                ->nullable();
            $table->date('borrowed_at')
                ->nullable()
                ->comment('tanggal peminjaman');
            $table->string('borrowed_status')
                ->nullable()
                ->comment('status peminjaman, value: verification, Accepted, Rejected');
            $table->date('returned_at')
                ->nullable()
                ->comment('tanggal pengembalian');
            $table->string('returned_status')
                ->nullable()
                ->comment('status pengembalian barang, value: verification, Accepted, Rejected');
            $table->dateTime('returned_by_user_at')
                ->nullable()
                ->comment('tanggal pengembalian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
