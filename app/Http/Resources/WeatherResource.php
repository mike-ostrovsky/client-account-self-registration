<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'temp' => $this['main']['temp'],
            'pressure' => $this['main']['pressure'],
            'humidity' => $this['main']['humidity'],
            'temp_min' => $this['main']['temp_min'],
            'temp_max' => $this['main']['temp_max'],
        ];
    }
}
