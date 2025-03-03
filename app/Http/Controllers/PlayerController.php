<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Models\Player;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlayerController extends Controller
{
    public function index()
    {
        $players = PlayerResource::collection(Player::all());

        return Inertia::render('Players/List')
            ->with('Players', $players);
    }

    public function store(PlayerRequest $request)
    {
        dd(request()->all());
        Player::create($request->validated());
    }

    public function update(PlayerRequest $request, Player $player)
    {
        dd(request()->all());
        $player->update($request->validated());
    }

    public function destroy(Player $player)
    {
        $player->delete();
    }

    public function deposit(Request $request, Player $player)
    {
        $amount = $request->input('amount');

        if ($amount <= 0) {
            return response()->json(['error' => 'Сумма должна быть положительной'], 400);
        }

        $player->updateBalance($amount, 'Пополнение', 'Пополнение баланса '.$amount);

        return response()->json(['message' => 'Баланс пополнен', 'balance' => $player->balance]);
    }

    public function history(Player $player)
    {
        return response()->json($player->balanceHistory()->latest()->get());
    }
}
