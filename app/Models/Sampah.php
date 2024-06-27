<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sampah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function garbage(): HasMany {
        return $this->hasMany(Setor::class, 'garbage_id', 'id');
    }

    public function categorized(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
