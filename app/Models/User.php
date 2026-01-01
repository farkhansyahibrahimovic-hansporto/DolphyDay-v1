<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get all micro actions for the user.
     */
    public function microActions()
    {
        return $this->hasMany(MicroAction::class);
    }

    /**
     * Get all growth logs for the user.
     */
    public function growthLogs()
    {
        return $this->hasMany(GrowthLog::class);
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is regular user.
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Get avatar URL.
     */
    public function getAvatarUrl()
    {
        if ($this->avatar && file_exists(public_path($this->avatar))) {
            // Return asset URL untuk avatar yang ada
            return asset($this->avatar);
        }
        
        // Default avatar menggunakan UI Avatars jika tidak ada avatar
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=3B82F6&color=fff&size=200";
    }
}