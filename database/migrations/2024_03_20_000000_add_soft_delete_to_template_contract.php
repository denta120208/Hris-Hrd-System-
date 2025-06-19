<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToTemplateContract extends Migration
{
    public function up()
    {
        Schema::table('template_contract', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('template_contract', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
} 