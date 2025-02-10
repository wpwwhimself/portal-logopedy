<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $incrementing = false;
    protected $primaryKey = "name";
    protected $keyType = "string";
    public $timestamps = false;

    public const META = [
        "label" => "Role",
        "icon" => "key-chain",
    ];

    protected $fillable = [
        "name",
        "description",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
