<?php

namespace JDD\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    protected $table = 'forms';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'content', 'state'];
    protected $visible = ['name', 'content', 'state'];
}
