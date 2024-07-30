<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    use HasFactory;

    protected $guarded = [ 
        'id', 'created_at', 'updated_at'
    ];

    public function postType() {
        return $this->belongsTo(PostType::class, 'post_type');
    }
}
