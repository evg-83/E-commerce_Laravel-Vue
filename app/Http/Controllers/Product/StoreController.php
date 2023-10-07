<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Models\ColorProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        // dd( $data );
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);

        if (isset($data['product_images'])) {
            $productImages = $data['product_images'];
            unset($data['product_images']);
        }

        // $filePathProduct = Storage::disk('public');

        // if ($request->hasFile("preview_image")) {
        //     $file = $request->file("preview_image");

        //     $imageName = time() . '_' . $file->getClientOriginalName();

        //     $file->move(\public_path("storage/images/"), $imageName);

        //     $data['preview_image'] = $imageName;
        // }

        if (isset($data['tags'])) {
            $tagsIds = $data['tags'];
            unset($data['tags']);
        }

        if (isset($data['colors'])) {
            $colorsIds = $data['colors'];
            unset($data['colors']);
        }

        $product = Product::firstOrCreate([
            'title' => $data['title']
        ], $data);

        foreach ($tagsIds as $tagsId) {
            ProductTag::firstOrCreate([
                'product_id' => $product->id,
                'tag_id'     => $tagsId,
            ]);
        }

        foreach ($colorsIds as $colorsId) {
            ColorProduct::firstOrCreate([
                'product_id' => $product->id,
                'color_id' => $colorsId,
            ]);
        }

        // if ($request->hasFile("productImages")) {
        //     $files = $request->file("productImages");

        //     foreach ($files as $file) {
        //         $imageName = time() . '_' . $file->getClientOriginalName();

        //         $request['product_id'] = $product->id;
        //         $request['file_path'] = $imageName;

        //         $file->move(\public_path("storage/images"), $imageName);

        //         ProductImage::create([
        //             'product_id' => $product->id,
        //             'file_path'  => $imageName,
        //         ]);
        //     }
        // }

        foreach ($productImages as $productImage) {
            $currentImages = ProductImage::where('product_id', $product->id)->get();

            if (count($currentImages) > 3) continue;

            $filePath = Storage::disk('public')->put('/images', $productImage);

            ProductImage::create([
                'product_id' => $product->id,
                'file_path'  => $filePath,
            ]);
        }

        return redirect()->route('product.index');
    }
}
