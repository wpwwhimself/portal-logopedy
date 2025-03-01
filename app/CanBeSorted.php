<?php

namespace App;

trait CanBeSorted
{
    public static function getSorts(): array
    {
        return array_filter(array_merge(
            [
                "name" => [
                    "label" => "Po nazwie",
                    "mode" => "field",
                    "discr" => "name",
                ],
            ],
            defined(static::class."::SORTS") ? self::SORTS : [],
        ));
    }

    public function sortable(array $sort_data)
    {
        switch ($sort_data["mode"]) {
            case "field":
                return $this->{$sort_data["discr"]};
            case "function":
                return $this->{$sort_data["discr"]}();
            default:
                throw new \InvalidArgumentException("Unknown sort mode: ".$sort_data["mode"]);
        }
    }
}
