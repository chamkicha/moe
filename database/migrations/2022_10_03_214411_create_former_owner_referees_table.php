<?php

use App\Models\Former_owner;
use App\Models\Owner;
use App\Models\Ward;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormerOwnerRefereesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('former_owner_referees', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('occupation')->nullable();
            $table->foreignIdFor(Former_owner::class,'former_owner_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Ward::class,'ward_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
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
        Schema::dropIfExists('former_owner_referees');
    }
}
