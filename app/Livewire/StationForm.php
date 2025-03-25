<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Station;

class StationForm extends Component
{
    public $stationId = null;
    public $name;
    public $type = 'gas';
    public $lat;
    public $lng;

    public function mount($id = null)
    {

        $this->stationId = $id;

        if ($id) {
            $station = Station::findOrFail($id);
            $this->name = $station->name;
            $this->type = $station->type;
            $this->lat = $station->lat;
            $this->lng = $station->lng;
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name' => 'required|string',
            'type' => 'required|in:gas,petrol,fire',
            'lat'  => 'required|numeric',
            'lng'  => 'required|numeric',
        ]);

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
