<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }
    public function detailGarbage(): BelongsTo
    {
        return $this->belongsTo(Sampah::class, 'sampah_id', 'id');
    }
}
