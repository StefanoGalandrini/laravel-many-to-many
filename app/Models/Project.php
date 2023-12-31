<?php

namespace App\Models;

use App\Models\Technology;
use App\Models\Type;
use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Slugger;

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

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getRouteKey()
    {
        return $this->slug;
    }
}
