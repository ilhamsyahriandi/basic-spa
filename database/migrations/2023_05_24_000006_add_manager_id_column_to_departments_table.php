<?php

use App\Support\DatabaseTableNames;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->foreignId('manager_id')->nullable()->constrained(DatabaseTableNames::EMPLOYEES);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(DatabaseTableNames::DEPARTMENTS, function (Blueprint $table) {
            $table->dropColumn('manager_id');
        });
    }
};
