<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpawnProductsCostRequest;
use App\Http\Resources\DBItemResource;
use App\Http\Resources\SpawnProductsCostResource;
use App\Models\DBItem;
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
        SpawnProductsCost::create($request->validated());
    }

    public function update(SpawnProductsCostRequest $request, SpawnProductsCost $ProductCost)
    {
        $ProductCost->update($request->validated());
    }

    public function destroy(SpawnProductsCost $ProductCost)
    {
        $ProductCost->delete();
    }
}
