<?php

namespace App\Models;

use App\CanBeStringified;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CanBeStringified;

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
