<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'status' => 200,
            'meals' => $this->collection->transform(function ($meal) {
                return [
                    'id' => $meal->id,
                    'status' => $meal->status,
                    'name' => $meal->name, 
                    'description' => $meal->description,
                    'ingredients' => $meal->ingredients->pluck('title'), 
                    'tags' => $meal->tags->pluck('title'), 
                    'category' => $meal->category->title
                ];
            }),
            'currentPage' => $this->currentPage(),
            'lastPage' => $this->lastPage()
        ];
    }
}
