<?php

use App\Models\School_category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnSchoolCategoryIdToTableCertificateTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificate_types', function (Blueprint $table) {
            $table->foreignIdFor(School_category::class,'school_category_id')->nullable()->index()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificate_types', function (Blueprint $table) {
            $table->dropColumn('school_category_id');
        });
    }
}
