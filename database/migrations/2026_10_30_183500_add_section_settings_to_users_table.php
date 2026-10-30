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
        Schema::table('users', function (Blueprint $table) {
            $table->string('about_image_path')->nullable()->after('avatar_path');
            $table->string('bento_image_1')->nullable()->after('about_image_path');
            $table->string('bento_image_2')->nullable()->after('bento_image_1');
            $table->string('cta_image_path')->nullable()->after('bento_image_2');
            $table->string('about_title')->nullable()->after('bio');
            $table->text('about_description')->nullable()->after('about_title');
            $table->string('years_experience')->nullable()->after('about_description');
            $table->string('projects_completed')->nullable()->after('years_experience');
            $table->string('support_available')->nullable()->after('projects_completed');
            $table->string('client_satisfaction')->nullable()->after('support_available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'about_image_path',
                'bento_image_1',
                'bento_image_2',
                'cta_image_path',
                'about_title',
                'about_description',
                'years_experience',
                'projects_completed',
                'support_available',
                'client_satisfaction',
            ]);
        });
    }
};

