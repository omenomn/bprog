<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function tree()
    {
        $categories = Category::limit(5000)->get();

        $tree = [];
        $categoriesKeyed = $categories->keyBy('id')->toArray();

        foreach ($categories->toArray() as $category) {

            $id = $category['id'];
            $path = $id;
            $childCategory = $category;
            $childrenPath = '';

            while ($category['parent_id']) {
                $category = $categoriesKeyed[$category['parent_id']];
                $childrenPath = $category['id'] . '.children.' . $childrenPath;
                $path = $category['id'] . '.children.' . $path;
            }

            array_set($tree, $path, $childCategory);    

            if (strlen($childrenPath) > 5) {
                $childrenPath = trim($childrenPath, '.');
                $children = array_get($tree, $childrenPath);
                $children = collect($children)->sortBy('place')->toArray();

                array_set($tree, $childrenPath, $children);    
            }
        }

        dd($tree);
    }

    protected function setKey($category)
    {
        return ($category['parent_id']) ? 
            '(' . $category['parent_id'] . ').children.(' . $category['id'] . ')' :  
            '(' . $category['id'] . ')';
    }
}
