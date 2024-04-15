<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'property_id',
    ];

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function imageUrl()
    {
        return Storage::disk("public")->url($this->name);
    }
}
