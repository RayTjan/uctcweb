<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditionsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('uctc_users', function (Blueprint $table) {
            $table->string("activation_token")->nullable();
            $table->enum('is_active',['0','1'])->default('0')->after('is_login');
            $table->enum('is_verified',['0','1'])->default('0')->after('is_login');
            $table->integer('identity_id');
            $table->string("identity_type");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uctc_users', function (Blueprint $table) {
            $table->dropColumn("activation_token");
            $table->dropColumn('is_active');
            $table->dropColumn('is_verified');
            $table->dropColumn('identity_id');
            $table->dropColumn('identity_type');

        });
    }
}
