<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Search\Searchable;

class Problem extends Model
{
    use Searchable;
    
    protected $connection = 'pgsql';
    protected $table = 'problem';
    protected $primaryKey = 'id_problem';
}
