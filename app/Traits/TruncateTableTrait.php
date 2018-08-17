<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait TruncateTableTrait
{
    public function truncateTables()
    {
        if (! isset($this->truncate)) {
            return;
        }
        Schema::disableForeignKeyConstraints();
        foreach ($this->truncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
    }
}
