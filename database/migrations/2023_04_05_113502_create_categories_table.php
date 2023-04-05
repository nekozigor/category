<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Lang;

return new class extends Migration
{
    
    const CATEGORY = 'categories';

    const LANG = 'category_langs';

    public function up(): void
    {
        Schema::create(self::CATEGORY, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();

            $table->unique(['id', 'parent_id']);
        });

        Schema::create(self::LANG, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lang_id')->notnull();
            $table->unsignedInteger('category_id')->notnull();
            $table->string('name')->notnull();

            $table->unique(['category_id', 'lang_id']);

            $table->foreign('category_id')
                ->references('id')->on(self::CATEGORY)
                ->onDelete('cascade');

            $table->foreign('lang_id')
                ->references('id')->on((new Lang)->getTable())
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::LANG);
        Schema::dropIfExists(self::CATEGORY);
    }
};
