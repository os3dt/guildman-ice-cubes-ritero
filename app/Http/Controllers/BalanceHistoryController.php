<?php

namespace App\Http\Controllers;

use App\Http\Requests\BalanceHistoryRequest;
use App\Http\Resources\BalanceHistoryResource;
use App\Models\BalanceHistory;

class BalanceHistoryController extends Controller
{
    public function index()
    {
        return BalanceHistoryResource::collection(BalanceHistory::all());
    }

    public function store(BalanceHistoryRequest $request)
    {
        BalanceHistory::create($request->validated());
    }

    public function show(BalanceHistory $balanceHistory)
    {
        return new BalanceHistoryResource($balanceHistory);
    }

    public function update(BalanceHistoryRequest $request, BalanceHistory $balanceHistory)
    {
        $balanceHistory->update($request->validated());
    }

    public function destroy(BalanceHistory $balanceHistory)
    {
        $balanceHistory->delete();
    }

    public function playerHistory()
    {
        
    }
}
