<?php

namespace App\Http\Controllers;

use App\Http\Requests\VdsStoreRequest;
use App\Http\Requests\VdsUpdateRequest;
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

    public function store(VdsStoreRequest $request)
    {
        $vds = new Vds;

        $vds->login = $request->login;
        $vds->password = $request->password;
        $vds->ip = $request->ip;
        $vds->port = $request->port;
        $vds->location_id = $request->location;
        $vds->cores = $request->cores;

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
    public function update(VdsUpdateRequest $request, string $id)
    {
        $vds = new Vds;
        if (!$vds->find($id)) {
            session(['alert' => __('VDS не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.vds');
        }
        $valid = $vds->where(['ip' => $request->ip])->first();
        if($valid->id != $id){
            session(['alert' => __('Vds с таким ip уже есть!'), 'a_status' => 'danger']);
            return back()->withInput();
        }

        $vds->where(['id' => $id])->update([
            'login' => $request->login,
            'password' => $request->password,
            'ip' => $request->ip,
            'port' => $request->port,
            'location_id' => $request->location,
            'cores' => $request->cores,
            'status' => $request->status,
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
