<?php

use E98Developer\LaravelChangelogManagerPackage\Enums\ChangelogTypeEnum;
use E98Developer\LaravelChangelogManagerPackage\Models\ChangelogRelease;
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
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();
            $table->enum('type',array_column(ChangelogTypeEnum::cases(), 'value'))->default(ChangelogTypeEnum::ADD->value)->index();
            $table->longText('description')->nullable();
            $table->foreignIdFor(ChangelogRelease::class)->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changelogs');
    }
};
