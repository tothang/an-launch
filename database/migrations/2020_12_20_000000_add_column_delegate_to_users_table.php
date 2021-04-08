<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class AddColumnDelegateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('role')->nullable();
            $table->string('dealership_name')->nullable();
            $table->string('employee_function')->nullable();
            $table->string('brand')->nullable();
            $table->string('breakout_group')->nullable();
            $table->string('status')->default(User::STATUS_NEW);
            $table->string('declined_reason')->nullable();
            $table->string('language')->nullable();
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
                'title',
                'role',
                'dealership_name',
                'employee_function',
                'brand',
                'breakout_group',
                'status',
                'declined_reason',
                'language'
            ]);
        });
    }
}
