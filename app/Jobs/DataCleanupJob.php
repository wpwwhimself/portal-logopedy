<?php

namespace App\Jobs;

use App\CanLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class DataCleanupJob implements ShouldQueue
{
    use Queueable;

    use CanLog;
    public const ICON = "🧹";

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $entities_to_cleanup = [
            "courses",
            "universities",
        ];

        self::log("Starting");

        foreach ($entities_to_cleanup as $model_name) {
            self::log("Cleaning up " . $model_name);

            $model = "App\\Models\\" . Str::of($model_name)->studly()->singular();
            $model::all()->each(function ($entity) use ($model, $model_name) {
                self::log("Analyzing $model_name #". $entity->id, "debug", 1);

                // explode improper JSON strings
                foreach (collect($model::FIELDS)
                    ->filter(fn ($field) => $field["type"] == "JSON")
                    ->keys()
                    ->all() as $field_name
                ) {
                    self::log("Analyzing JSON column $field_name", "debug", 2);
                    if ($entity->{$field_name}?->count() == 1
                        && Str::of($entity->{$field_name}->first())->contains(",")
                    ) {
                        self::log("💥 Exploding JSON column $field_name", "info", 2);
                        $entity->{$field_name} = collect($entity->{$field_name})
                            ->map(fn ($item) => explode(",", $item))
                            ->flatten()
                            ->unique();
                        $entity->save();
                    }
                }
            });
        }

        self::log("Done");
    }
}
