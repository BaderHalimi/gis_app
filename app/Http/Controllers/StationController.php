<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::select('id', 'name', 'lat', 'lng', 'type')->paginate(10); // 10 عناصر لكل صفحة
        return view('stations', compact('stations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:gas,petrol,fire',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        Station::create($request->all());

        return redirect()->intended(route('stations.index'))->with('success', 'تمت إضافة المحطة بنجاح!');
    }
    public function create()
    {
        session(['url.intended' => url()->previous()]);
        return view('stations.create');
    }

    public function show(Station $station)
    {
        return view('stations.show', compact('station'));
    }
    public function edit(Station $station)
    {
        return view('stations.edit', compact('station'));
    }
    public function update(Request $request, Station $station)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:gas,petrol,fire',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $station->update($request->all());

        return redirect()->back()->with('success', 'تم تعديل المحطة بنجاح!');
    }
    public function destroy(Station $station)
    {
        $station->delete();

        return redirect()->back()->with('success', 'تم حذف المحطة بنجاح!');
    }
}
