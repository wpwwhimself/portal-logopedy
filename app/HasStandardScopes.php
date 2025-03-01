<?php

namespace App;

use Illuminate\Support\Facades\Auth;

trait HasStandardScopes
{
    public function scopeForAdminList($query)
    {
        return $query->orderBy("order")
            ->orderBy("name");
    }

    public function scopeVisible($query, bool $sort = true)
    {
        $query = $query->where("visible", ">", 1 - Auth::check());
        if ($sort) $query = $query
            ->orderBy("order")
            ->orderBy("name");
        return $query;
    }

    public function scopeRecent($query, ?string $except_id = null)
    {
        return $query->where("visible", ">", 1 - Auth::check())
            ->orderByDesc("updated_at")
            ->where("id", "!=", $except_id)
            ->limit(3);
    }

    public function scopeClasses($query, string $field)
    {
        return $query->select($field)->get()
            ->pluck($field)
            ->flatten()
            ->sort()
            ->unique();
    }
}
