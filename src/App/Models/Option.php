<?php

namespace Etherbase\App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {

    protected $fillable = ['option_name', 'option_value', 'autoload'];
    
}
