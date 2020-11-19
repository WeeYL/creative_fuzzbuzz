<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Profile()
    {
        return $this->belongsTo(Profile::class,);
    }

    public function Backers()
    {
        return $this->belongsToMany(Profile::class,'profile_projects','profile_id','project_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Status()
    {
        return $this->belongsTo(Status::class);
    }
}
