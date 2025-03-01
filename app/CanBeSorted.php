<?php

namespace App;

trait CanBeSorted
{
    public static function getSorts(): array
    {
        return array_filter(array_merge(
            [
                "updated_at" => [
                    "label" => "Po dacie aktualizacji",
                    "compare-using" => "field",
                    "discr" => "updated_at",
                ],
                "name" => [
                    "label" => "Po nazwie",
                    "compare-using" => "field",
                    "discr" => "name",
                ],
            ],
            defined(static::class."::SORTS") ? self::SORTS : [],
        ));
    }

    public function discr(array $data)
    {
        switch ($data["compare-using"]) {
            case "field":
                return $this->{$data["discr"]};
            case "function":
                return $this->{$data["discr"]}();
            default:
                throw new \InvalidArgumentException("Unknown sort criterion: ".$data["compare-using"]);
        }
    }
}
