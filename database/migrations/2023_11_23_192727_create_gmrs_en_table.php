<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGMRSEnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('gmrs_en', function (Blueprint $table) {
            $table->integer('usid')->unsigned()->primary();
            $table->string('city',20)->nullable();
            $table->string('state',2)->nullable();
            $table->string('frn',10)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * 'usid' => $usid,
     * 'callsign' => $callsign,
     * 'status' => $status,
     * 'expiration' => $expiration,
     *
     *1    usid PrimaryIndex    int        UNSIGNED    No    None            Change Change    Drop Drop
     * 2    frn Index    char(11)    utf8mb4_unicode_520_ci        Yes    NULL            Change Change    Drop Drop
     * 3    callsign Index    varchar(25)    utf8mb4_unicode_520_ci        No    None            Change Change    Drop Drop
     * 4    status    char(1)    utf8mb4_unicode_520_ci        No    None            Change Change    Drop Drop
     * 5    expiration    char(10)    utf8mb4_unicode_520_ci        No    None
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('gmrs_en');
    }
}
