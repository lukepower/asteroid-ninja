<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class SearchObservationsByObservatoryCode extends Component
{
    public function render()
    {
        // Get the list of obscodes
        $obscodes = Cache::remember('obscodes', 6000, function () {
            return \App\Models\ObservatoryCode::orderBy('code')->get();
        });

        return view('livewire.search-observations-by-observatory-code')
            ->with('obscodes', $obscodes);
    }
}
