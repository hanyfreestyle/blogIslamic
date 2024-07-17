<?php

namespace App\AppCore\UploadFilter;

use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use App\AppCore\UploadFilter\Request\UploadFilterSizeRequest;
use App\Http\Controllers\AdminMainController;

use Illuminate\Support\Facades\Cache;

class UploadFilterSizeController extends AdminMainController {

    function __construct() {

        parent::__construct();
        $this->controllerName = "upFilter";
        $this->PrefixRole = 'config';
        $this->selMenu = "config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/upFilter.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddButToCard' => false,
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_upFilter_view', ['only' => ['index']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('upload_filter_list_cash');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create($filterId) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $FilterData = UploadFilter::findOrFail($filterId);
        $rowData = UploadFilterSize::with('filter')->findOrNew(0);
        $rowData['filter_id'] = $filterId;
        $rowData['canvas_back'] = $FilterData->canvas_back;
        $rowData['type'] = $FilterData->type;
        $rowData['get_more_option'] = '0';
        $rowData['get_add_text'] = '0';
        $rowData['get_watermark'] = '0';

        return view('admin.appCore.photo_filter.form_size', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $rowData = UploadFilterSize::with('filter')->findOrFail($id);
        return view('admin.appCore.photo_filter.form_size', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UploadFilterSizeRequest $request, $id) {

        $saveData = UploadFilterSize::findOrNew($id);

        $saveData->filter_id = $request->filter_id;
        $saveData->type = $request->type;
        $saveData->new_w = $request->new_w;
        $saveData->new_h = $request->new_h;
        $saveData->canvas_back = $request->canvas_back;

        $saveData->get_more_option = $request->get_more_option;
        $saveData->get_add_text = $request->get_add_text;
        $saveData->get_watermark = $request->get_watermark;

        $saveData->save();
        self::ClearCash();
        if ($id == '0') {
            return redirect(route('admin.config.upFilter.edit', $request->filter_id))->with('Add.Done', '');
        } else {
            return redirect(route('admin.config.upFilter.edit', $request->filter_id))->with('Edit.Done', '');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = UploadFilterSize::findOrFail($id);
        $filterId = $deleteRow->filter_id;
        $deleteRow->delete();
        self::ClearCash();
        return redirect(route('config.upFilter.edit', $filterId))->with('confirmDelete', '');
    }


}
