<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'link',
        'user_id'
    ];

    /**
     * @param object $q
     * @param string $code
     */
    public function scopeGetByCode(object $q, string $code)
    {
        $q->where('code', $code);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
