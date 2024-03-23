<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class);
    }
}
