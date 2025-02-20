<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceIceRequest;
use App\Http\Resources\DBItemResource;
use App\Http\Resources\PriceIceResource;
use App\Models\DBItem;
use App\Models\PriceIce;

class PriceIceController extends Controller
{
    public function index()
    {
        $dbItems = DBItemResource::collection(DBItem::all());
        $icePrices = PriceIceResource::collection(
            PriceIce::query()
                ->with('dbItem')
                ->with('dbPrice')
                ->get()
        );
        return inertia('PriceIce/Index')
            ->with('icePrices', $icePrices)
            ->with('dbItems', $dbItems);
    }

    public function store(PriceIceRequest $request)
    {
        PriceIce::create($request->validated());
    }

    public function update(PriceIceRequest $request, PriceIce $PriceIce)
    {
        $PriceIce->update($request->validated());
    }

    public function destroy(PriceIce $PriceIce)
    {
        $PriceIce->delete();
    }
}
