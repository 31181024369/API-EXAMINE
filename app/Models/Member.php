<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'member';

    protected $fillable = [
        'username',
        'password',
        'email',
        'registration_date',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'registration_date' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'member_id');
    }

    public function userExams()
    {
        return $this->hasMany(UserExam::class, 'member_id');
    }

    public function userExamHistories()
    {
        return $this->hasMany(UserExamHistory::class, 'member_id');
    }

    public function userTopicAttempts()
    {
        return $this->hasMany(UserTopicAttempts::class, 'member_id');
    }

    public function userPosts()
    {
        return $this->hasMany(UserPost::class, 'member_id');
    }
}
