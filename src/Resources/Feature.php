<?php

namespace A2htray\GDBMozart\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Feature extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
