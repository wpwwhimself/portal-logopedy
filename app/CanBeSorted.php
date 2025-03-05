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

    public static function queryableFields(): array
    {
        return array_keys(array_filter(self::FIELDS, fn ($f) =>
            in_array($f["type"], ["text", "TEXT", "HTML"])
            || $f["type"] == "JSON" && count($f["column-types"]) == 1 && current($f["column-types"]) == "text"
        ));
    }
}
