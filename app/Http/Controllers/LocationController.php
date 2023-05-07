<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{

    public function location(Request $request)
    {

        $locs = new Location;
        return view('admin.location.index', ['locs' => $locs->paginate(10)]);
    }

    public function edit(string $id)
    {
        $loc = new Location;
        if (!$loc->find($id)) {
            session(['alert' => __('Локация не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.location');
        }
        return view('admin.location.edit', ['loc' => $loc->find($id)]);
    }
    public function update(LocationUpdateRequest $request, string $id)
    {
        $loc = new Location;
        if (!$loc->find($id)) {
            session(['alert' => __('Локация не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.location');
        }
        $valid = $loc->where(['name' => $request->name])->first();
        if($valid->id != $id){
            session(['alert' => __('Локация с таким названием уже есть!'), 'a_status' => 'danger']);
            return back()->withInput();
        }
        $loc->where(['id' => $id])->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        session(['alert' => __('Локация успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.location');
    }
    public function create()
    {
        return view('admin.location.create');
    }

    public function store(LocationStoreRequest $request)
    {
        $loc = new Location;
        $loc->name = $request->name;

        $loc->save();
        session(['alert' => __('Локация успешно создана!'), 'a_status' => 'success']);

        return redirect()->route('admin.location');
    }
    public function destroy(string $id)
    {
        $loc = new Location;


        if(!$loc->find($id)){
            session(['alert' => __('Локация не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.location');
        }

        $objects = 0;
        $objects = $objects + modelCountEl("Vds", 'location', $id);
        if($objects > 0){
            session(['alert' => __('Вы не можете удалить локацию так как есть созданые обьекты с привязаным его id!'), 'a_status' => 'danger']);

            return redirect()->route('admin.location');
        }

        $loc->find($id)->delete();

        session(['alert' => __('Локация успешно удалена!'), 'a_status' => 'success']);

        return redirect()->route('admin.location');
    }
}
