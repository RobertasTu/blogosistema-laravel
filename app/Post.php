<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use Kyslik\ColumnSortable\Sortable;



class Post extends Model
{
    use Sortable;
    protected $table = 'posts';
    protected $fillable = ['title', 'excerpt', 'description', 'category_id'];
    public $sortable = ['id', 'title', 'category_id'];

    public function postCategory() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
