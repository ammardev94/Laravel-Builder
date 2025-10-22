<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'title', 
        'canonical_url', 
        'status', 
        'type', 
        'visibility'
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function getPublishedAttribute()
    {
        return $this->status ? 'Published' : 'Draft';
    }
}
