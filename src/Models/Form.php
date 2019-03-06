<?php

namespace JDD\Forms\Models;

use App\Model;

class Form extends Model
{
    protected $table = 'forms';
    public $timestamps = true;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'content', 'state'];
    protected $attributes = ['name' => '', 'content' => '{"$":{},"JddContainer":[]}', 'state' => 'public'];
    protected $visible = ['name', 'content', 'state'];
    protected $casts = [
        'content' => 'array',
    ];
}
