<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\WebMainController;
use Illuminate\Support\Facades\Auth;


class PagesViewController extends WebMainController {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {

        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';
        $pageView['page'] = 'page_index';

        return view('web.index')->with([
            'pageView' => $pageView,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   UnderConstruction
    public function UnderConstruction() {
        $config = WebMainController::getWebConfig(0);
        if($config->web_status == 1 or Auth::check()) {
            return redirect()->route('page_index');
        }
        $meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($meta, 'page_index');

        return view('under');
    }
}
