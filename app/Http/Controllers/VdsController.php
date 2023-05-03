<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vds;
use App\Models\Location;
use Illuminate\Validation\Rule;

class VdsController extends Controller
{
    public function vds()
    {
        $vds = new Vds;
        return view('admin.vds.index', ['vds' => $vds->paginate(10)]);
    }

    public function create()
    {
        $locs = new Location;
        return view('admin.vds.create', ['locs' => $locs->all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'ip' => ['required', 'string', 'ip', 'unique:vds'],
            'port' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'cores' => ['required', 'integer']
        ]);
        $vds = new Vds;

        $vds->login = $validated['login'];
        $vds->password = $validated['password'];
        $vds->ip = $validated['ip'];
        $vds->port = $validated['port'];
        $vds->location_id = $validated['location'];
        $vds->cores = $validated['cores'];

        $vds->save();
        session(['alert' => __('Вы успешно создали vds!'), 'a_status' => 'success']);
        return redirect()->route('admin.index');
    }

    public function edit($id)
    {
        $vds = new Vds;
        if (!$vds->find($id)) {
            session(['alert' => __('VDS не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.vds');
        }
        $locs = new Location;
        return view('admin.vds.edit', ['vds' => $vds->find($id), 'locs' => $locs->all()]);
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'ip' => ['required', 'string', 'ip', Rule::unique('vds')->ignore($id)],
            'port' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'cores' => ['required', 'integer'],
            'status' => ['required', 'boolean']
        ]);
        $vds = new Vds;
        if (!$vds->find($id)) {
            session(['alert' => __('VDS не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.vds');
        }
        $vds->where(['id' => $id])->update([
            'login' => $validated['login'],
            'password' => $validated['password'],
            'ip' => $validated['ip'],
            'port' => $validated['port'],
            'location_id' => $validated['location'],
            'cores' => $validated['cores'],
            'status' => $validated['status'],
        ]);
        session(['alert' => __('Vds успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.vds');
    }

    public function destroy(string $id)
    {
        $vds = new Vds;

        if(!$vds->find($id)){
            session(['alert' => __('VDS не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.vds');
        }
        $objects = 0;
        //$objects = $objects + modelCountEl("Server", 'vds', $id);
        if($objects > 0){
            session(['alert' => __('Вы не можете удалить vds так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.vsd');
        }
        $vds->find($id)->delete();

        session(['alert' => __('VDS успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.vds');
    }

}
