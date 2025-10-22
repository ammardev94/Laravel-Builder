<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionField extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_section_id', 
        'field_name', 
        'field_label', 
        'field_type', 
        'field_value', 
        'sort_order'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}
