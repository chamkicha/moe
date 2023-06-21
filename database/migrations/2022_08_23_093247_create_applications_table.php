<?php

use App\Models\Application_category;
use App\Models\Registry_type;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('secure_token')->nullable();
            $table->string('foreign_token')->nullable();
            $table->string('tracking_number')->nullable();
            $table->foreignIdFor(User::class,'user_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Registry_type::class,'registry_type_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->foreignIdFor(Application_category::class,'application_category_id')->nullable()->index()->constrained()->onDelete('cascade');
            $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('applications');
    }
}
