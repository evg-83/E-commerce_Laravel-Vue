<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Product $product)
    {
        $tags       = Tag::all();
        $colors     = Color::all();
        $categories = Category::all();
        $groups     = Group::all();

        $data = $request->validated();

        if (array_key_exists('preview_image', $data)) {
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        }

        $productImagesIds = isset($data['product_images']) ? $data['product_images'] : null;
        // $imageIdsForDelete = isset($data['image_ids_for_delete']) ? $data['image_ids_for_delete'] : null;

        unset($data['product_images']);

        // if (isset($data['product_images'])) {
        //     $productImagesIds = $data['product_images'];
        //     unset($data['product_images']);
        // }

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
            $product->tags()->sync($tagsIds);
        }

        if (isset($colorsIds)) {
            $product->colors()->sync($colorsIds);
        }

        $currentImages = $product->productImages;

        if ($productImagesIds) {
            foreach ($currentImages as $currentImage) {
                Storage::disk('public')->delete($currentImage->file_path);
                $currentImage->delete();

                // if (in_array($currentImage->id, $productImagesIds)) {
                //     Storage::disk('public')->delete($currentImage->file_path);
                //     $currentImage->delete();
                // }
            }
        }

        if ($productImagesIds) {
            foreach ($productImagesIds as $productImageIds) {
                // $name = md5(Carbon::now() . '_' . $productImage->getClientOriginalName()) . '.' . $productImage->getClientOriginalExtension();

                $filePath = Storage::disk('public')->put('/images', $productImageIds);

                ProductImage::create([
                    'product_id' => $product->id,
                    'file_path'  => $filePath,
                ]);
            }
        }

        // if (isset($productImages)) {
        //     foreach ($productImages as $productImage) {
        //         $images = ProductImage::all();
        //         $currentImagesProductId  = $images->where('product_id', '==', $product->id);

        //         $filePath = Storage::disk('public')->put('/images', $productImage);

        //         foreach ($currentImagesProductId as $currentImageProductId) {
        //             $product->productImages()->create([
        //                 'product_id' => $product->id,
        //                 'file_path'  => $filePath,
        //             ]);
        //         }
        //     }
        // }

        // $productImages = ProductImage::all();
        // $productImage  = $productImages->where('product_id', '==', $product->id);
        // dd($productImage);


        // $filePathProduct = Storage::disk('public');

        // $productId = Product::findOrFail($id);
        // if ($request->hasFile("preview_image")) {

        //     $productId = $product->id;

        //     if (File::exists("public/storage/images/" . $productId->preview_image)) {
        //         File::delete("public/storage/images/" . $productId->preview_image);
        //     }

        //     $file = $request->file("preview_image");

        //     $product->preview_image = time() . "_" . $file->getClientOriginalName();

        //     $file->move(\public_path("/storage/images/"), $product->preview_image);

        //     $request['preview_image'] = $product->preview_image;
        // }

        // $product->update([
        //     'title'         => $request->title,
        //     'description'   => $request->description,
        //     'content'       => $request->content,
        //     'preview_image' => $product->preview_image,
        //     'price'         => $request->price,
        //     'count'         => $request->count,
        //     'category_id'   => $request->category_id,
        //     'group_id'      => $request->group_id,
        //     'oldPrice'      => $request->oldPrice,
        // ]);

        // if (isset($tagsIds)) {
        //     $product->tags()->sync($tagsIds);
        // }

        // if (isset($colorsIds)) {
        //     $product->colors()->sync($colorsIds);
        // }

        // if ($request->hasFile("productImages")) {
        //     $files = $request->file("productImages");
        //     foreach ($files as $file) {
        //         $imageName = time() . '_' . $file->getClientOriginalName();
        //         $productId = $product->id;

        //         $request["product_id"] = $productId;
        //         $request["file_path"]  = $imageName;

        //         $file->move(\public_path("storage/images"), $imageName);

        //         ProductImage::create([
        //             'product_id' => $productId,
        //             'file_path'  => $imageName,
        //         ]);
        //     }
        // }

        // $fileImages = $request->hasFile("file_path");

        // if (isset($productImages)) {
        //     foreach ($productImages as $productImage) {
        //         $currentImages = ProductImage::where('product_id', $product->id)->get();

        //         if (count($currentImages) > 3) continue;

        //         $filePath = Storage::disk('public')->put('/images', $productImage);

        //         ProductImage::create([
        //             'product_id' => $product->id,
        //             'file_path'  => $filePath,
        //         ]);
        //     }
        // }

        return view('product.show', compact('product', 'categories', 'tags', 'colors', 'groups'));
    }
}
