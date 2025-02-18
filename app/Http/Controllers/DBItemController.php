<?php

namespace App\Http\Controllers;

use App\Http\Requests\DBItemRequest;
use App\Http\Resources\DBItemResource;
use App\Models\DBItem;

class DBItemController extends Controller
{
    public function index()
    {
        $dbItems = DBItem::all();
        return inertia('MinecraftDB/Index')
            ->with('db_items', $dbItems);
    }

    public function store(DBItemRequest $request)
    {
        DBItem::create($request->validated());
    }

    public function update(DBItemRequest $request, DBItem $DBItem)
    {
        $DBItem->update($request->validated());
    }

    public function destroy(DBItem $DBItem)
    {
        $DBItem->delete();
    }
}
