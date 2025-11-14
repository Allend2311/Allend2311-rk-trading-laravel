<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname');
            $table->string('lname');
            $table->string('mname')->nullable();
            $table->text('address');
            $table->date('birthday');
            $table->enum('user_type', ['customer', 'admin'])->default('customer');
            $table->boolean('email_verified')->default(false);
            $table->string('verification_code', 10)->nullable();
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
            $table->dropColumn(['fname', 'lname', 'mname', 'address', 'birthday', 'user_type', 'email_verified', 'verification_code']);
        });
    }
};
