<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Rate;
use App\Models\Vds;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function rates()
    {
        $rate = new Rate;
        return view('admin.rates.index', ['rates' => $rate->paginate(10)]);
    }

    public function create()
    {
        $vds = new Vds;
        $games = new Game;
        return view('admin.rates.create', ['games' => $games->all(), 'vds' => $vds->all()]);
    }

    public function store(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'min_s' => ['required', 'int'],
            'max_s' => ['required', 'int'],
            'price' => ['required', 'decimal:2'],
            'quota' => ['required', 'int'],
            'tick' => ['int'],
            'vds_id' => ['required', 'int', 'exists:vds,id'],
            'game_id' => ['required', 'int', 'exists:games,id'],
            'addons' => ['required', 'boolean'],
            'ftp' => ['required', 'boolean'],
            'fastdl' => ['required', 'boolean'],
            'tv' => ['required', 'boolean'],
        ]);
        $rate = new Rate;
        $rate->name = $validated['name'];
        $rate->price = $validated['price'];
        $rate->min_s = $validated['min_s'];
        $rate->max_s = $validated['max_s'];
        $rate->quota = $validated['quota'];
        $rate->tick = $validated['tick'];
        $rate->vds_id = $validated['vds_id'];
        $rate->game_id = $validated['game_id'];
        $rate->addons = $validated['addons'];
        $rate->ftp = $validated['ftp'];
        $rate->fastdl = $validated['fastdl'];
        $rate->tv = $validated['tv'];

        $rate->save();

        session(['alert' => __('Тариф успешно создана!'), 'a_status' => 'success']);

        return redirect()->route('admin.index');
    }

    public function edit(string $id)
    {
        $rate = new Rate;
        if (!$rate->find($id)) {
            session(['alert' => __('Тариф не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        $vds = new Vds;
        $games = new Game;
        return view('admin.rates.edit', ['rate' => $rate->find($id), 'vds' => $vds->all(), 'games' => $games->all()]);
    }

    public function update(Request $request, string $id)
    {
        $rate = new Rate;
        if (!$rate->find($id)) {
            session(['alert' => __('Тариф не найден'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'min_s' => ['required', 'int'],
            'max_s' => ['required', 'int'],
            'price' => ['required', 'decimal:2'],
            'quota' => ['required', 'int'],
            'tick' => ['int'],
            'vds_id' => ['required', 'int', 'exists:vds,id'],
            'game_id' => ['required', 'int', 'exists:games,id'],
            'addons' => ['required', 'boolean'],
            'ftp' => ['required', 'boolean'],
            'fastdl' => ['required', 'boolean'],
            'tv' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);
        // нужно написать остаток кода когда доделаю сервера на проверку подключенных серверу услуг что б небыло
        // что человек включил ftp а потом отключили к нему доступ а ftp остался и остальным дополнениям.
        $rate->where(['id' => $id])->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'min_s' => $validated['min_s'],
            'max_s' => $validated['max_s'],
            'quota' => $validated['quota'],
            'tick' => $validated['tick'],
            'vds_id' => $validated['vds_id'],
            'game_id' => $validated['game_id'],
            'addons' => $validated['addons'],
            'ftp' => $validated['ftp'],
            'fastdl' => $validated['fastdl'],
            'tv' => $validated['tv'],
            'status' => $validated['status'],
        ]);
        session(['alert' => __('Тариф успешно именён!'), 'a_status' => 'success']);

        return redirect()->route('admin.rates');
    }

    public function destroy(string $id)
    {
        $rate = new Rate;
        if (!$rate->find($id)) {
            session(['alert' => __('Тариф не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }

        $objects = 0;
        //$objects = $objects + modelCountEl("Server", 'rate', $id);
        if ($objects > 0) {
            session(['alert' => __('Вы не можете удалить Тариф так как есть созданые сервера с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        $rate->find($id)->delete();

        session(['alert' => __('Тариф успешно удален!'), 'a_status' => 'success']);

        return redirect()->route('admin.rates');
    }


}
