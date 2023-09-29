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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama', 100);
            $table->string('rombel', 100)->unique();
            $table->foreignId('id_guru')->nullable()->unique()->references('id')->on('guru')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('kouta_siswa');
            $table->foreignId('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
