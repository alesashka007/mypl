<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Validation\Rule;

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
        $game->name = $request->get('name');
        $game->code = $request->get('code');
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
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:35'],
            'code' => ['required', 'string', 'max:8', Rule::unique('games')->ignore($id)],
            'status' => ['required', 'boolean']
        ]);
        $game = new Game;
        if (!$game->find($id)) {
            session(['alert' => __('Игра не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }
        $game->where(['id' => $id])->update([
            'name' => $validated['name'],
            'code' => $validated['code'],
            'status' => $validated['status']
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
// will need        $objects = $objects + modelCountEl("Server", 'game', $id);
        if($objects > 0){
            session(['alert' => __('Вы не можете удалить игру так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.games');
        }

        $game->find($id)->delete();

        session(['alert' => __('Игра успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.games');
    }
}
