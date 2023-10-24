<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTimeWorkTypesTable extends Migration
{
    public function up()
    {
        Schema::table('time_work_types', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8953318')->references('id')->on('users');
        });
    }
}
