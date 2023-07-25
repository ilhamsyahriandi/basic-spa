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
        Schema::create(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->foreignId('parent_id')->nullable();
            $table->string('description')->nullable();
        });

        Schema::table(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->foreign('parent_id')
            ->references('id')
            ->on(DatabaseTableNames::DEPARTMENTS)
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
        Schema::dropIfExists(DatabaseTableNames::DEPARTMENTS);

        Schema::table(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }
};
