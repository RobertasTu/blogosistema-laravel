<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Post;

class Category extends Model
{
    use Sortable;
    protected $table = 'categories';
    protected $fillable = ['title'];
    public $sortable = ['id', 'title'];

    public function categoryPosts() {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
