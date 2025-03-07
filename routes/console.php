<?php

use App\Jobs\DataCleanupJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new DataCleanupJob)->cron(env("APP_ENV") == "local"
    ? "* * * * *"
    : "0 * * * *"
);
