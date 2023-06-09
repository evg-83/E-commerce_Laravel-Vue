<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\Tag;

class ShowController extends Controller
{
    public function __invoke(Product $product)
    {
        $tags       = Tag::all();
        $colors     = Color::all();
        $categories = Category::all();
        $groups     = Group::all();

        return view('product.show', compact('product', 'tags', 'colors', 'categories', 'groups'));
    }
}
