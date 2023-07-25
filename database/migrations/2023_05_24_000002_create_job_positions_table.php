<?php

use App\Support\DatabaseTableNames;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create(DatabaseTableNames::JOB_POSITIONS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('department_id')
                ->constrained(DatabaseTableNames::DEPARTMENTS)
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
            ;

            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::JOB_POSITIONS);
    }
};
