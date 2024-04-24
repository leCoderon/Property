<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyRessource extends JsonResource
{
    // public static $wrap = "property";
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            $this->mergeWhen(
                true,
                [
                    'price' => $this->price
                ]
            ),
            'images' => ImageRessource::collection($this->images),
            'options' => OptionRessource::collection($this->whenLoaded('options')),
        ];
    }
}
