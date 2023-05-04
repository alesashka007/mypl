<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

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
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'status' => ['required', 'boolean'],
        ]);
        $loc = new Location;
        if (!$loc->find($id)) {
            session(['alert' => __('Локация не найдена!'), 'a_status' => 'danger']);

            return redirect()->route('admin.location');
        }
        $loc->where(['id' => $id])->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
        ]);
        session(['alert' => __('Локация успешно изменена!'), 'a_status' => 'success']);

        return redirect()->route('admin.location');
    }
    public function create()
    {
        return view('admin.location.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:40'],
        ]);
        $loc = new Location;
        $loc->name = $validated['name'];

        $loc->save();
        session(['alert' => __('Локация успешно создана!'), 'a_status' => 'success']);

        return redirect()->route('admin.index');
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
