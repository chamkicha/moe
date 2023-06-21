<?php

use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_infos', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('name')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('institute_email')->nullable();
            $table->string('institute_phone')->nullable();
            $table->string('box')->nullable();
            $table->foreignIdFor(Ward::class,'ward_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->longText('registration_certificate_copy')->nullable();
            $table->longText('organizational_constitution')->nullable();
            $table->longText('agreement_document')->nullable();
            $table->text('institute_address')->nullable();
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
        Schema::dropIfExists('institute_infos');
    }
}
