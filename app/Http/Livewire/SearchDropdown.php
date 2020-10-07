<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\product;
use App\category;
class SearchDropdown extends Component
{
    public $query ='';
    public $result;
    public function mount(){
        $this->query='';
        $this->result = [];
    }

    public function updatedQuery(){
            $this->result = product::where('name','like','%'.$this->query.'%')
                ->limit(10)
                ->get()
                ->toArray();
    }
    public function render()
    {

        return view('livewire.search-dropdown');
    }
}
