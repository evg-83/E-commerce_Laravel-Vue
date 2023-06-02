<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content,
            'image_url'     => $this->imageUrl,
            'price'         => $this->price,
            'oldPrice'      => $this->oldPrice,
            'count'         => $this->count,
            'is_published'  => $this->is_published,
            'category'      => new CategoryResource($this->category),
        ];
    }
}
