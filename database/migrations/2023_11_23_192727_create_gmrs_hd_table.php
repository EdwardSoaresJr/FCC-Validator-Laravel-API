<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGMRSHdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('gmrs_hd', function (Blueprint $table) {
            $table->integer('usid')->unsigned()->primary();
            $table->string('callsign',10)->index();
            $table->string('status',1);
            $table->string('expiration',10);
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
        Schema::dropIfExists('gmrs_hd');
    }
}
