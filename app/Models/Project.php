<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url_image',
        'description',
        'creation_date',
        'url_repo',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
