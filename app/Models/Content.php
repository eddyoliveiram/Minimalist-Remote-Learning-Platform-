<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'type',
        'text_typed',
        'file_uploaded',
        'video_url',
        'module_id'
    ];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'id');
    }

}
