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
        Schema::table('QuanTriVien', function (Blueprint $table) {
            $table->foreign('MaVT')->references('MaVT')->on('VaiTro')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('QuanTriVien', function (Blueprint $table) {
            $table->dropForeign(['MaVT']); // Xóa khóa ngoại
        });
    }

};
