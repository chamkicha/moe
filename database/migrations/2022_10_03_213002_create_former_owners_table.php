<?php

use App\Models\Establishing_school;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormerOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('former_owners', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->foreignIdFor(Establishing_school::class,'establishing_school_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->string('tracking_number')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('authorized_person')->nullable();
            $table->string('title')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('purpose')->nullable();
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
        Schema::dropIfExists('former_owners');
    }
}
