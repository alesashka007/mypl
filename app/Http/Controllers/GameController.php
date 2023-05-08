<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Models\Game;

class GameController extends Controller
{
    public function games()
    {
        $game = new Game;
        return view('admin.games.index', ['games' => $game->all()]);
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
        $game = new Game;
        if (!$game->find($id)) {
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }
        return view('admin.games.edit', ['game' => $game->find($id)]);
    }
    public function update(GameUpdateRequest $request, string $id)
    {
        $game = new Game;
        if (!$game->find($id)) {
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }
        $valid = $game->where(['code' => $request->code])->first();
        if($valid->id != $id){
            session(['alert' => __('Игра с таким кодом уже есть!'), 'a_status' => 'danger']);
            return back()->withInput();
        }
        $game->where(['id' => $id])->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status
        ]);
        session(['alert' => __('Игра успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.games');
    }

    public function destroy(string $id)
    {
        $game = new Game;


        if(!$game->find($id)){
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        $objects = 0;
        $objects = $objects + modelCountEl("Rate", 'game', $id);
        if($objects > 0){
            session(['alert' => __('Вы не можете удалить игру так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        $game->find($id)->delete();

        session(['alert' => __('Игра успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.games');
    }
}
