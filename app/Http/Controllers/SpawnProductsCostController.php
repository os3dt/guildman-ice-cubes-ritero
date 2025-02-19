<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpawnProductsCostRequest;
use App\Http\Resources\DBItemResource;
use App\Http\Resources\SpawnProductsCostResource;
use App\Models\DBItem;
use App\Models\DBPrice;
use App\Models\SpawnProductsCost;

class SpawnProductsCostController extends Controller
{
    public function index()
    {
        $dbItems = DBItemResource::collection(DBItem::all());
        $productsCost = SpawnProductsCostResource::collection(
            SpawnProductsCost::query()->orderBy('db_item_id', 'desc')->with('dbItem')->get()
        );

        return inertia('SpawnTrade/Index')
            ->with('db_items', $dbItems)
            ->with('productCosts', $productsCost);
    }

    public function store(SpawnProductsCostRequest $request)
    {
        $productCost = SpawnProductsCost::create($request->validated());

        $this->recalculatePrice($productCost->db_item_id);
    }

    public function update(SpawnProductsCostRequest $request, SpawnProductsCost $ProductCost)
    {
        $ProductCost->update($request->validated());

        $this->recalculatePrice($ProductCost->db_item_id);
    }

    public function destroy(SpawnProductsCost $ProductCost)
    {
        $dbItemId = $ProductCost->db_item_id;
        $ProductCost->delete();

        $this->recalculatePrice($dbItemId);
    }

    private function recalculatePrice(int $dbItemId): void
    {
        $costs = SpawnProductsCost::where('db_item_id', $dbItemId)->get();

        if ($costs->isEmpty()) {
            DBPrice::where('db_item_id', $dbItemId)->delete();
            return;
        }

        $avgOne = $costs->avg('one_item');
        $avgStack = $costs->avg('one_stack');
        $avgShulker = $costs->avg('one_shulker');

        DBPrice::updateOrCreate(
            ['db_item_id' => $dbItemId],
            ['avg_one' => $avgOne, 'avg_stack' => $avgStack, 'avg_shulker' => $avgShulker]
        );
    }
}
