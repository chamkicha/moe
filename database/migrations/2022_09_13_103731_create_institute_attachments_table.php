<?php

use App\Models\Attachment_type;
use App\Models\Institute_info;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Institute_info::class,'institute_info_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Attachment_type::class,'attachment_type_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->longText('attachment')->nullable();
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
        Schema::dropIfExists('institute_attachments');
    }
}
