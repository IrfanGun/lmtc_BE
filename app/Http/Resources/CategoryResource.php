<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubCategoryResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_featured' => $this->is_featured,
            'subcategory' => $this->whenLoaded('subCategory', function () {
                    return SubCategoryResource::collection($this->subCategory);
                }
            ),
            
        ];
    }
}
