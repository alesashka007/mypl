<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateStoreRequest;
use App\Http\Requests\RateUpdateRequest;
use App\Models\Game;
use App\Models\Rate;
use App\Models\Vds;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function rates()
    {
        $rates = Rate::query()->paginate(10);
        return view('admin.rates.index', ['rates' => $rates]);
    }

    public function create()
    {
        $vds = Vds::query()->get();
        $games = Game::query()->get();
        return view('admin.rates.create', ['games' => $games, 'vds' => $vds]);
    }

    public function store(RateStoreRequest $request)
    {
        $rate = new Rate;
        $rate->name = $request->name;
        $rate->price = $request->price;
        $rate->min_s = $request->min_s;
        $rate->max_s = $request->max_s;
        $rate->quota = $request->quota;
        $rate->tick = $request->tick;
        $rate->vds_id = $request->vds_id;
        $rate->game_id = $request->game_id;
        $rate->addons = $request->addons;
        $rate->ftp = $request->ftp;
        $rate->fastdl = $request->fastdl;
        $rate->tv = $request->tv;

        $rate->save();

        session(['alert' => __('Тариф успешно создана!'), 'a_status' => 'success']);

        return redirect()->route('admin.index');
    }

    public function edit(string $id)
    {
        $rate = Rate::query()->find($id);
        if (!$rate) {
            session(['alert' => __('Тариф не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        $vds = Vds::query()->get();
        $games = Game::query()->get();
        return view('admin.rates.edit', ['rate' => $rate, 'vds' => $vds, 'games' => $games]);
    }

    public function update(RateUpdateRequest $request, string $id)
    {
        $rate = Rate::query()->find($id);
        if (!$rate) {
            session(['alert' => __('Тариф не найден'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        // нужно написать остаток кода когда доделаю сервера на проверку подключенных серверу услуг что б небыло
        // что человек включил ftp а потом отключили к нему доступ а ftp остался и остальным дополнениям.
        $rate->update([
            'name' => $request->name,
            'price' => $request->price,
            'min_s' => $request->min_s,
            'max_s' => $request->max_s,
            'quota' => $request->quota,
            'tick' => $request->tick,
            'vds_id' => $request->vds_id,
            'game_id' => $request->game_id,
            'addons' => $request->addons,
            'ftp' => $request->ftp,
            'fastdl' => $request->fastdl,
            'tv' => $request->tv,
            'status' => $request->status,
        ]);
        session(['alert' => __('Тариф успешно именён!'), 'a_status' => 'success']);

        return redirect()->route('admin.rates');
    }

    public function destroy(string $id)
    {
        $rate = Rate::query()->find($id);
        if (!$rate) {
            session(['alert' => __('Тариф не найден!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }

        $objects = 0;
        //$objects = $objects + modelCountEl("Server", 'rate', $id);
        if ($objects > 0) {
            session(['alert' => __('Вы не можете удалить Тариф так как есть созданые сервера с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.rates');
        }
        $rate->delete();

        session(['alert' => __('Тариф успешно удален!'), 'a_status' => 'success']);

        return redirect()->route('admin.rates');
    }


}
