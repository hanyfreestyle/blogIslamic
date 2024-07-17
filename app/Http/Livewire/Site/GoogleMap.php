<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class GoogleMap extends Component
{

    public $row ;
    public $title;
    public $lat;
    public $long;
    public $view = false;

    public function render()
    {
        if($this->row->listing_type == 'Project' or $this->row->listing_type == 'ForSale' ){
            if($this->row->latitude != null and  $this->row->longitude != null ){
                $this->lat = $this->row->latitude;
                $this->long =  $this->row->longitude;
            }
        }elseif ($this->row->listing_type == 'Unit'){
            if($this->row->latitude == null and  $this->row->longitude == null ){
                if($this->row->projectName->latitude  != null and  $this->row->projectName->longitude != null )
                    $this->lat = $this->row->projectName->latitude;
                $this->long =  $this->row->projectName->longitude;
            }
        }

        return view('livewire.site.google-map');
    }

    public function loadMap(){
        $this->view = true;
    }

}
