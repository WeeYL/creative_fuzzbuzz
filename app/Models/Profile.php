<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Projects()
    {
        return $this->hasMany(Project::class,);
    }

    public function Backing()
    {
        // 3rd and 4th argument is the left and right column values
        return $this->belongsToMany(Project::class, 'profile_projects', 'profile_id', 'project_id')->latest()->withTimestamps();
    }
}
