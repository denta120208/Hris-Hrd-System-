<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTypeToTemplateContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('template_contract', function (Blueprint $table) {
            $table->string('type')->default('PKWT')->after('file_temp');
        });

        // Update existing records to PKWT
        DB::table('template_contract')->update(['type' => 'PKWT']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('template_contract', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
} 