<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


// models
use App\Models\Project;

class Type extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function genSlug($name)
    {
        return Str::slug($name, "-");
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
