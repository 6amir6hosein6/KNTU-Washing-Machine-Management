<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->index('machine_id');
            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');

            $table->unsignedBigInteger('student_id');
            $table->index('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->string('receiptID');
            $table->integer('status');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->dropForeign('lists_student_id_foreign');
            $table->dropIndex('lists_student_id_index');
            $table->dropColumn('student_id');

            $table->dropForeign('lists_machine_id_foreign');
            $table->dropIndex('lists_machine_id_index');
            $table->dropColumn('machine_id');
        });
        Schema::dropIfExists('reserves');
    }
};
