<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->text('born_place')->nullable()->after('avatar');
            $table->date('born_date')->nullable()->after('born_place');
            $table->tinyInteger('gender')->nullable()->after('born_date');
            $table->text('address')->nullable()->after('gender');
            $table->text('institute')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'born_place',
                'born_date',
                'gender',
                'address',
                'institute',
            ]);
        });
    }
}
