<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function tree()
    {
        $categories = Category::get()->toArray();

    	$dotTree = [];

    	foreach ($categories as $category) {
            $categoryKey = $this->setKey($category);
            
            foreach ($dotTree as $treeKey => $value) {

                preg_match('/^(.*\(' . $category['parent_id'] . '\)).*$/i', $treeKey, $matches);

                if (count($matches) == 2) {
                    $categoryKey = $matches[1] . '.children.(' . $category['id'] . ')';
                    break;
                }
            }
            
            foreach ($dotTree as $treeKey => $value) {

                preg_match('/^(.*\(' . $category['id'] . '\))(.*)$/i', $treeKey, $matches);

                if (count($matches) == 3) {
                    $replacedCategory = $dotTree[$treeKey];
                    unset($dotTree[$treeKey]);
                    $dotTree[$categoryKey . $matches[2]] = $replacedCategory;
                }
            }

            $dotTree[$categoryKey] = $category;
    	}

        dd($dotTree);

        $placeDotTree = [];

        foreach ($dotTree as $key => $item) {
            $item['dot_key'] = $key;
            $placeDotTree[strlen($key)][] = $item;
        }

        foreach ($placeDotTree as $key => $group) {
            $placeDotTree[$key] = collect($group)->sortBy('place')->toArray();
        }

        ksort($placeDotTree);
        $tree = [];

        foreach ($placeDotTree as $group) {
            foreach ($group as $item) {
                foreach ($item as $key => $value) {
                    if ($key != 'dot_key') {
                        array_set($tree, $item['dot_key'] . '.' . $key, $value);      
                    }              
                }
            };
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
