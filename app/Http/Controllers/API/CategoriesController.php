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

    	$dotTree = [];

    	// foreach ($categories as $category) {
     //        $categoryKey = $this->setKey($category);
            
     //        foreach ($dotTree as $treeKey => $value) {

     //            preg_match('/^(.*\(' . $category['parent_id'] . '\)).*$/i', $treeKey, $matches);

     //            if (count($matches) == 2) {
     //                $categoryKey = $matches[1] . '.children.(' . $category['id'] . ')';
     //                break;
     //            }
     //        }
            
     //        foreach ($dotTree as $treeKey => $value) {

     //            preg_match('/^(.*\(' . $category['id'] . '\))(.*)$/i', $treeKey, $matches);

     //            if (count($matches) == 3) {
     //                $replacedCategory = $dotTree[$treeKey];
     //                unset($dotTree[$treeKey]);
     //                $dotTree[$categoryKey . $matches[2]] = $replacedCategory;
     //            }
     //        }

     //        $dotTree[$categoryKey] = $category;
    	// }

     //    $placeDotTree = [];

     //    foreach ($dotTree as $key => $item) {
     //        $item['dot_key'] = $key;
     //        $placeDotTree[strlen($key)][] = $item;
     //    }

     //    foreach ($placeDotTree as $key => $group) {
     //        $placeDotTree[$key] = collect($group)->sortBy('place')->toArray();
     //    }

     //    ksort($placeDotTree);
     //    $tree = [];

     //    foreach ($placeDotTree as $group) {
     //        foreach ($group as $item) {
     //            foreach ($item as $key => $value) {
     //                if ($key != 'dot_key') {
     //                    array_set($tree, $item['dot_key'] . '.' . $key, $value);      
     //                }              
     //            }
     //        };
     //    }

     //    dd($tree);

        /**
        
        1-3
        6-3
        2-
        3-2
        4-5
        5-2

        3.1
        3.6
        2
        2.3

        foreach ($categories as &$category) {
            
        }



        **/

        // $count = $categories->count();

        // for ($i = 0; $i < $count; $i++) {
        //     ->get('name')
        //     $parent = $categories->where('id', $category->parent_id)->first();
        //     $category = $category;
        //     $tree[] = $category->id;
        //     $category = $parent;
        // }

        $dotTree = [];
        $categoriesKeyed = $categories->keyBy('id')->toArray();

        foreach ($categories->toArray() as $category) {

            $id = $category['id'];
            $path = $id;
            $childCategory = $category;

            while ($category['parent_id']) {
                $category = $categoriesKeyed[$category['parent_id']];
                $path = $category['id'] . '.children.' . $path;

                foreach ($category as $prop => $value) {
                    $dotTree[$path . '.' . $prop] = $value; 
                }
            }

            foreach ($childCategory as $prop => $value) {
                $dotTree[$path . '.' . $prop] = $value; 
            }
        }

        $tree = [];

        foreach ($dotTree as $key => $value) {
            array_set($tree, $key, $value);    
        }

        dd('??');
    }

    protected function setKey($category)
    {
        return ($category['parent_id']) ? 
            '(' . $category['parent_id'] . ').children.(' . $category['id'] . ')' :  
            '(' . $category['id'] . ')';
    }
}
