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
        Schema::create(DatabaseTableNames::EMPLOYEES, function (Blueprint $table) {

            $table->id();
            $table->timestamps();

            // $table->foreignId('user_id')->constrained();
            $table->foreignId('job_position_id')->constrained(DatabaseTableNames::JOB_POSITIONS);
            $table->foreignId('department_id')->constrained(DatabaseTableNames::DEPARTMENTS);
            $table->foreignId('manager_id')->nullable();
            $table->foreignId('coach_id')->nullable();

            $table->string('name');
            $table->string('work_mobile')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('email');

        });

        Schema::table(DatabaseTableNames::EMPLOYEES, function (Blueprint $table) {
            $table->foreign('manager_id')
            ->references('id')
            ->on(DatabaseTableNames::EMPLOYEES)
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            ;

            $table->foreign('coach_id')
            ->references('id')
            ->on(DatabaseTableNames::EMPLOYEES)
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(DatabaseTableNames::EMPLOYEES);

        Schema::table(DatabaseTableNames::EMPLOYEES, function (Blueprint $table) {
            $table->dropColumn('manager_id');
            $table->dropColumn('coach_id');
        });
    }
};
