<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMatkhauColumnLengthInTaikhoanTable extends Migration
{
    public function up()
    {
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->string('MatKhau', 255)->change(); // Tăng độ dài lên 255 ký tự
        });
    }

    public function down()
    {
        Schema::table('taikhoan', function (Blueprint $table) {
            $table->string('MatKhau', 50)->change(); // Quay lại độ dài cũ (nếu cần)
        });
    }
}


