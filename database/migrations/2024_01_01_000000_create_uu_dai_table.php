<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uu_dai', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->text('mo_ta')->nullable();
            $table->string('hinh_anh');
            $table->decimal('gia', 12, 0);
            $table->boolean('trang_thai')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uu_dai');
    }
};
