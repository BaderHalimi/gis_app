<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Station;

class StationForm extends Component
{
    use WithFileUploads;

    public $stationId = null;
    public $name;
    public $type = 'gas';
    public $lat;
    public $lng;
    public $address;
    public $description;
    public $prices;
    public $images = [];

    public function mount($id = null)
    {
        $this->stationId = $id;

        if ($id) {
            $station = Station::findOrFail($id);
            $this->name        = $station->name;
            $this->type        = $station->type;
            $this->lat         = $station->lat;
            $this->lng         = $station->lng;
            $this->address     = $station->address;
            $this->description = $station->description;
            $this->prices      = $station->prices;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name'        => 'required|string',
            'type'        => 'required|in:gas,petrol,fire',
            'lat'         => 'required|numeric',
            'lng'         => 'required|numeric',
            'address'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'prices'      => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePaths = [];

        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $imagePaths[] = $image->store('stations', 'public'); // تخزين الصور بمجلد storage/app/public/stations
            }
        }

        if (!empty($imagePaths)) {
            $data['images'] = json_encode($imagePaths); // تخزين المسارات فقط
        }

        if ($this->stationId) {
            Station::findOrFail($this->stationId)->update($data);
            session()->flash('message', 'Station updated successfully!');
        } else {
            Station::create($data);
            session()->flash('message', 'Station created successfully!');
        }

        $this->redirectIntended(route('stations.index'), true);
    }

    public function render()
    {
        return view('livewire.station-form');
    }
}
