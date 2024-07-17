<?php

namespace App\AppCore\Menu;

use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;



class AdminMenuController extends AdminMainController {

    use CrudTraits;

    function __construct() {

        parent::__construct();
        $this->controllerName = "AdminMenu";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin.app_menu_admin_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;


        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => false,
            'restore' => 1,
            'AddButToCard' => false,

        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:config_view', ['only' => ['index']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashAdminMenuList');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $rowData = AdminMenu::query()->where('parent_id',null)->orderBy('postion')->get();
        return view('admin.appCore.menu.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function subIndex($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Sub";
        $mainMenu = AdminMenu::where('id',$id)->where('parent_id',null)->firstOrFail();
        $rowData = AdminMenu::query()->where('parent_id',$mainMenu->id)->orderBy('postion')->get();
        return view('admin.appCore.menu.index', compact('pageData', 'rowData','mainMenu'));
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SaveSort
    public function SaveSort(Request $request) {
        $positions = $request->positions;
        foreach ($positions as $position) {
            $id = $position[0];
            $newPosition = $position[1];
            $saveData = AdminMenu::findOrFail($id);
            $saveData->postion = $newPosition;
            $saveData->save();
        }
        self::ClearCash();
        return response()->json(['success' => $positions]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  updateStatus
    public function updateStatus(Request $request) {
        $thisId = $request->send_id;
        $updateData = AdminMenu::findOrFail($thisId);
        if($updateData->is_active == '1') {
            $updateData->is_active = '0';
        } else {
            $updateData->is_active = '1';
        }
        $updateData->save();
        self::ClearCash();
        return response()->json(['success' => $thisId]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashAdminMenu
    static function CashAdminMenu($stopCash = 0) {
        if ($stopCash) {
            $CashAdminMenuList = AdminMenu::where('is_active',true)
                ->where('parent_id',null)
                ->with('subMenu')
                ->orderby('postion')
                ->get();
        } else {
            $CashAdminMenuList = Cache::remember('CashAdminMenuList', cashDay(7), function () {
                return AdminMenu::where('is_active',true)
                    ->where('parent_id',null)
                    ->with('subMenu')
                    ->orderby('postion')
                    ->get();
            });
        }
        return $CashAdminMenuList;
    }


}
