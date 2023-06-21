<?php

use App\Models\Establishing_school;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Establishing_school::class,'establishing_school_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('tracking_number')->nullable();
            $table->string('manager_first_name')->nullable();
            $table->string('manager_middle_name')->nullable();
            $table->string('manager_last_name')->nullable();
            $table->string('occupation')->nullable();
            $table->foreignIdFor(Ward::class,'ward_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('house_number')->nullable();
            $table->string('street')->nullable();
            $table->string('manager_phone_number')->nullable();
            $table->string('manager_email')->nullable();
            $table->string('education_level')->nullable();
            $table->string('expertise_level')->nullable();
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
        Schema::dropIfExists('managers');
    }
}
