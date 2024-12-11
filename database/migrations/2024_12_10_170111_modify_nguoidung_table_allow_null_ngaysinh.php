<?php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNguoidungTableAllowNullNgaySinh extends Migration
{
    public function up()
    {
        Schema::table('nguoidung', function (Blueprint $table) {
            // Cho phép giá trị null cho cột NgaySinh
            $table->date('NgaySinh')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('nguoidung', function (Blueprint $table) {
            // Trở lại trạng thái không cho phép null
            $table->date('NgaySinh')->nullable(false)->change();
        });
    }
};
