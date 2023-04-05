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
        Schema::create('langs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->notnull();
            $table->string('short_name')->notnull();
        
            $table->unique('name');
            $table->unique('short_name');
        });

        DB::table('langs')->insert([
            [
                'name' => 'English',
                'short_name' => 'en',
                            ],
            [
                'name' => 'Deutch',
                'short_name' => 'de',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('langs');
    }
};
