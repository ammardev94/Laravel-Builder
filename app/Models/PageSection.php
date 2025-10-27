<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id', 
        'name', 
        'label', 
        'sort_order', 
        'background_type', 
        'background_value', 
        'visible'
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(PageSectionField::class);
    }

    public function field($name)
    {
        return $this->fields->where('field_name', $name)->first()?->field_value;
    }
}
