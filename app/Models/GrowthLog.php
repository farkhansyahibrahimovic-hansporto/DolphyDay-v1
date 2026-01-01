<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'reflection',
        'mood',
        'log_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'log_date' => 'date',
        ];
    }

    /**
     * Get the user that owns the growth log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include this month's logs.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereBetween('log_date', [
            now()->startOfMonth(),
            now()->endOfMonth()
        ]);
    }

    /**
     * Scope a query to only include logs with specific mood.
     */
    public function scopeByMood($query, string $mood)
    {
        return $query->where('mood', $mood);
    }

    /**
     * Get mood emoji.
     */
    public function getMoodEmoji(): string
    {
        return match($this->mood) {
            'peaceful' => '😌',
            'hopeful' => '🌱',
            'content' => '😊',
            'growing' => '🌟',
            'struggling' => '💭',
            default => '💙',
        };
    }

    /**
     * Get mood label.
     */
    public function getMoodLabel(): string
    {
        return match($this->mood) {
            'peaceful' => 'Peaceful',
            'hopeful' => 'Hopeful',
            'content' => 'Content',
            'growing' => 'Growing',
            'struggling' => 'Struggling',
            default => 'Unknown',
        };
    }
}