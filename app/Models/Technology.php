<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// models
use App\Models\Project;


class Technology extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function genSlug($name)
    {
        return Str::slug($name, "-");
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
