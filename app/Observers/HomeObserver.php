<?php

namespace App\Observers;

use Str;
use App\Models\Home;

class HomeObserver
{
    public function creating(Home $home): void
    {
        $home->code = Str::random(4);
    }
}
