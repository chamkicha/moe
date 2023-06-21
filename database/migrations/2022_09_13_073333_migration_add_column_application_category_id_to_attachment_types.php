<?php

use App\Models\Application_category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationAddColumnApplicationCategoryIdToAttachmentTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attachment_types', function (Blueprint $table) {
            $table->foreignIdFor(Application_category::class,'application_category_id')->nullable()->index()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attachment_types', function (Blueprint $table) {
            $table->dropColumn('application_category_id');
        });
    }
}
