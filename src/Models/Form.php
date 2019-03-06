<?php

namespace JDD\Forms\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    public $timestamps = true;

    protected $connection = 'hr';

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'content', 'state'];
    protected $attributes = ['name' => '', 'content' => '{}', 'state' => 'public'];
    protected $visible = ['name', 'content', 'state'];
}
