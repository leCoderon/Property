<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;
    // use SoftDeletes;



    protected $fillable = [
        'title',
        'description',
        'price',
        'rooms',
        'bedrooms',
        'surface',
        'bedrooms',
        'floor',
        'city',
        'postal_code',
        'address',
        'sold'
    ];

    protected $casts = [
        "updated_at" => 'string',
    ];



    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug()
    {
        return Str::slug($this->title);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function scopeAvailable(Builder $builder, bool $sold = true): void
    {
        $builder->where("sold", !$sold);
    }

    public function scopeRecent(Builder $builder): void
    {
        $builder->orderBy('updated_at', 'desc');
    }
}
