<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// models
use App\Models\Type;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ["title", "content", "slug", "type_id", "cover_image"];

    public static function genSlug($title)
    {
        return Str::slug($title, "-");
    }

    // types for project
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // technologies for project
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
