<?php

namespace Modules\ClickHome\Models;

use Illuminate\Database\Eloquent\Model;
use SolutionForest\FilamentTree\Concern\ModelTree;

class ObjectCategory extends Model
{
    use ModelTree;

    protected $fillable = ["parent_id", "title", "order", "description"];

    protected $table = 'object_categories';

}
