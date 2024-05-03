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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id', 100);
            $table->unsignedBigInteger('menu_id');
            $table->string('jumlah');
            $table->double('subtotal');
            $table->timestamps();
            $table->foreign('transaksi_id')->references('id')->on('transaksi')->cascadeOnDelete();
            $table->foreign('menu_id')->references('id')->on('menu')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
