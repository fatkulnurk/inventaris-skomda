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
                ->comment('Kategori/Jenis Barang')
                ->nullable()
                ->constrained('categories');
            $table->text('description')
                ->comment('Deskripsi barang')
                ->nullable();
            $table->text('spesification')
                ->comment('Spesifikasi')
                ->nullable();
            $table->text('origin_of_acquisition')
                ->comment('Asal perolehan')
                ->nullable();
            $table->foreignUuid('building_id')
                ->comment('Gedung')
                ->nullable()
                ->constrained('buildings');
            $table->foreignUuid('room_id')
                ->comment('Ruang')
                ->nullable()
                ->constrained('rooms');

            // todo: tambah lokasi barang saat peminjaman untuk riwayat
            $table->string('series_number')
                ->comment('No Seri')
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
                ->comment('Jumlah barang')
                ->default(1);
            $table->unsignedSmallInteger('procurement_year')
                ->comment('tahun pengadaan')
                ->nullable();
            $table->unsignedDecimal('price', 20, 2)
                ->comment('harga satuan')
                ->nullable();
            $table->dateTime('registration_date')
                ->comment('Tanggal Pendaftaran Barang')
                ->nullable();
            $table->text('photo')->nullable();
            $table->string('status')
                ->nullable()
                ->comment('status barang di pinjam atau tidak (but make sure to use this or use the status from the transaction table)');
            $table->text('barcode')->nullable();
            $table->text('note')
                ->comment('Keterangan')
                ->nullable();
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
