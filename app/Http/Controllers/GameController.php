<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Models\Game;

class GameController extends Controller
{
    public function games()
    {
        $games = Game::query()->get();
        return view('admin.games.index', ['games' => $games]);
    }

    public function create()
    {
        return view('admin.games.create');
    }
    public function store(GameStoreRequest $request)
    {
        $game = new Game;

        $game->name = $request->name;
        $game->code = $request->code;

        $game->save();
        session(['alert' => __('Игра успешно создана'), 'a_status' => 'success']);
        return redirect()->route('admin.games');
    }

    public function edit(string $id)
    {
        $game = Game::query()->find($id);
        if (!$game) {
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }
        return view('admin.games.edit', ['game' => $game]);
    }
    public function update(GameUpdateRequest $request, string $id)
    {
        $game = Game::query()->find($id);

        if (!$game) {
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        $game->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status
        ]);

        session(['alert' => __('Игра успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.games');
    }

    public function destroy(string $id)
    {
        $game = Game::query()->find($id);

        if(!$game){
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        if($game->rates->count() > 0){
            session(['alert' => __('Вы не можете удалить игру так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        $game->delete();

        session(['alert' => __('Игра успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.games');
    }
}
