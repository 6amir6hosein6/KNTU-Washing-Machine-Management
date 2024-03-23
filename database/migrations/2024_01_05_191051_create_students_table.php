<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text("studentID");
            $table->string('password');
            $table->unsignedBigInteger('dorm_id');
            $table->index('dorm_id');
            $table->foreign('dorm_id')->references('id')->on('dorms')->onDelete('cascade');
            $table->text('name');
            $table->bigInteger('wallet');
            $table->timestamps();
        });

        \App\Models\Student::create(
            [
                'studentID'=>'40112894',
                'password'=>Hash::make("0021979677"),'dorm_id'=>1,
                'name' => 'امیرحسین نجفی',
                'wallet' => 999999999,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('lists_dorm_id_foreign');
            $table->dropIndex('lists_dorm_id_index');
            $table->dropColumn('dorm_id');
        });
        Schema::dropIfExists('students');
    }
};
