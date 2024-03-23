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
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('dorm_id');
            $table->integer('status');
            $table->timestamps();
        });

        \App\Models\Machine::create(['dorm_id' => 1, 'code' => 'QD-3DAN6', 'status' => '0']);
        \App\Models\Machine::create(['dorm_id' => 1, 'code' => 'QD-RTK79', 'status' => '0']);
        \App\Models\Machine::create(['dorm_id' => 1, 'code' => 'QD-3D32F', 'status' => '0']);
        \App\Models\Machine::create(['dorm_id' => 1, 'code' => 'QD-KIHN3', 'status' => '0']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign('lists_dorm_id_foreign');
            $table->dropIndex('lists_dorm_id_index');
            $table->dropColumn('dorm_id');
        });

        Schema::dropIfExists('machines');


    }
};
