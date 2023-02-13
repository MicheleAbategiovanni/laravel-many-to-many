<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["title", "description", "thumb", "github_link", "type_id"];

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
