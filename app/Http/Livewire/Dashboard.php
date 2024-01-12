<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;

class Dashboard extends Component
{
    public function render()
    {
        $latestDocuments = Document::latest()->take(15)->get();
        $totalDocuments = Document::count();
        $totalTerminated = Document::where('status', 'Terminated')->count();
        $encoded = Document::where('receivedby',0)->count();
        return view('livewire.dashboard', [
            'latestDocuments' => $latestDocuments,
            'encoded' => $encoded,
            'totalDocuments' => $totalDocuments,
            'totalTerminated' => $totalTerminated,
        ]);

    }
}
