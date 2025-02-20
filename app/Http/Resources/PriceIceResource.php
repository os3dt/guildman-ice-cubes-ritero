<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\PriceIce */
class PriceIceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'one' => $this->one,
            'stack' => $this->stack,
            'shulker' => $this->shulker,
            'db_item_id' => $this->db_item_id,
            'dbItem' => new DBItemResource($this->whenLoaded('dbItem')),
            'dbPrice' => $this->dbPrice ? [
                'avg_one' => $this->dbPrice->avg_one,
                'avg_stack' => $this->dbPrice->avg_stack,
                'avg_shulker' => $this->dbPrice->avg_shulker,
            ] : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
