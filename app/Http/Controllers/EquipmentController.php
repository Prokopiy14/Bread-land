<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentWorkload;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();
        $equipmentLoad = EquipmentWorkload::all();

        return view('equipments.index', compact('equipments'));

    }

    public function create()
    {
        return view('equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
        ]);

        Equipment::query()->create([
            'title'=> $request['title'],
            'description'=> $request['description'],
        ]);


        alert('Оборудование '.$request->title.' добалено');
        return redirect('equipments');

    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);
        return view('equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
        ]);

        $equipment = Equipment::find($id);
        $equipment->update($validated);

        alert('Данные об оборудовании '.$request->title.' были обновлены');
        return redirect('equipments');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        if ($equipment)
        {
            $equipment->delete();
        }

        alert('Оборудование '.$equipment->title.' удалено');
        return redirect()->back();
    }
}
