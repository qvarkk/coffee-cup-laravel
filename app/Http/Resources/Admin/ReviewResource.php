<?php

namespace App\Http\Resources\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'category' => new CategoryResource(Category::find($this->category_id)),
            'serving' => $this->serving,
            'in_stock' => $this->in_stock,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
