<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $tags       = Tag::all();
        $colors     = Color::all();
        $categories = Category::all();
        $data = $request->validated();

        if (array_key_exists('preview_image', $data)) {
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        }

        if (isset($data['tags'])) {
            $tagsIds = $data['tags'];
            unset($data['tags']);
        }

        if (isset($data['colors'])) {
            $colorsIds = $data['colors'];
            unset($data['colors']);
        }

        $product->update($data);

        if (isset($tagsIds)) {
            $product->tags()->sync( $tagsIds );
        }

        if (isset($colorsIds)) {
            $product->colors()->sync( $colorsIds );
        }

        return view('product.show', compact('product', 'categories', 'tags', 'colors'));
    }
}
