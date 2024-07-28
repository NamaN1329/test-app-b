<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    use HasFactory;

    protected $guarded = [
        "id",
        "created_at",
        "updated_at",
    ];

    public function posts() {
        return $this->hasMany(Post::class, "title")->whereDate("date", Carbon::today());
    }
}
