<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimestampsFromNguoidung extends Migration
{
    public function up()
    {
        Schema::table('nguoidung', function (Blueprint $table) {
            // Kiểm tra nếu cột 'created_at' tồn tại thì mới xóa
            if (Schema::hasColumn('nguoidung', 'created_at')) {
                $table->dropColumn('created_at');
            }

            // Kiểm tra nếu cột 'updated_at' tồn tại thì mới xóa
            if (Schema::hasColumn('nguoidung', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('nguoidung', function (Blueprint $table) {
            $table->timestamps(); // Khôi phục lại cột created_at và updated_at nếu cần
        });
    }
}


