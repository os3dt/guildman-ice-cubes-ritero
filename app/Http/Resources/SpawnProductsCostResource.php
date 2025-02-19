<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\SpawnProductsCost */
class SpawnProductsCostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'one_stack' => $this->one_stack,
            'one_shulker' => $this->one_shulker,
            'trader' => $this->trader,
            'db_item_id' => $this->db_item_id,
            'dbItem' => new DBItemResource($this->whenLoaded('dbItem')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
