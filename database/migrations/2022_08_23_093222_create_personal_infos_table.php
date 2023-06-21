<?php

use App\Models\Identity_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('occupation')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('personal_phone_number')->nullable();
            $table->foreignIdFor(Identity_type::class,'identity_type_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('personal_id_number')->nullable();
            $table->text('personal_address')->nullable();
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
        Schema::dropIfExists('personal_infos');
    }
}
