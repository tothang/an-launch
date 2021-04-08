<?php

use App\Modules\Registration\Models\UserRegistration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRegistrationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id')->unique()->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->default(UserRegistration::STATUS_NOT_REGISTERED);
            $table->boolean('attending')->default(false);
            $table->string('forename')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
            $table->text('reason_not_attending')->nullable();
            $table->dateTime('registered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_registrations');
    }
}
