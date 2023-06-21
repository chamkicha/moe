<?php

use App\Models\Ownership_type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnershipSubTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ownership_sub_types', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token');
            $table->foreignIdFor(Ownership_type::class,'ownership_type_id')->index()->constrained();
            $table->string('sub_type');
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
        Schema::dropIfExists('ownership_sub_types');
    }
}
