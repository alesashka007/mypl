<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Rate;

class OrderController extends Controller
{
    public function order()
    {
        $games = new Game;
        return view('order.index', ['games' => $games->where(['status' => 1])->get()]);
    }

    public function game(string $id)
    {
//        dd($id);
        $games = new Game;
        if (!$games->where(['id' => $id, 'status' => 1])->first()) {
            session(['alert' => __('Игра не найдена или отключена!'), 'a_status' => 'danger']);
            return redirect()->route('order');
        }
        $rates = new Rate;
        return view('order.game', ['game' => $games->find($id), 'games' => $games->where(['status' => 1])->get(), 'rates' => $rates->where(['status' => 1])->get()]);
    }

    public function servers()
    {
        $rates = new Rate;
        return view('order.servers', ['rates' => $rates->where(['status' => 1])->get()]);
    }
}
