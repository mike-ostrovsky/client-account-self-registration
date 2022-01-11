<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WeatherResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (empty($this['main'])) {
            return [];
        }

        return [
            'temp' => $this['main']['temp'],
            'pressure' => $this['main']['pressure'],
            'humidity' => $this['main']['humidity'],
            'temp_min' => $this['main']['temp_min'],
            'temp_max' => $this['main']['temp_max'],
        ];
    }
}
