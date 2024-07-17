<?php

namespace App\AppCore\UploadFilter;

use App\AppCore\UploadFilter\Models\UploadFilter;
use App\AppCore\UploadFilter\Models\UploadFilterSize;
use App\AppCore\UploadFilter\Request\UploadFilterRequest;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;


use Illuminate\Support\Facades\Cache;


class UploadFilterController extends AdminMainController {

    use CrudTraits;

    function __construct(UploadFilter $model) {

        parent::__construct();
        $this->controllerName = "upFilter";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/upFilter.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0],
            'restore' => 1,
        ];
        self::loadConstructData($sendArr);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('upload_filter_list_cash');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = UploadFilter::onlyTrashed()->count();
        $rowData = self::getSelectQuery(UploadFilter::where('id', '!=', 0));
        return view('admin.appCore.photo_filter.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(UploadFilter::onlyTrashed());
        return view('admin.appCore.photo_filter.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";

        $rowData = UploadFilter::findOrNew(0);
        $rowData['canvas_back'] = '#FFFFFF';
        $rowData['quality_val'] = '85';
        $rowData['convert_state'] = '1';
        $rowData['type'] = '0';
        $rowData['blur_size'] = '0';
        $rowData['pixelate_size'] = '5';
        $rowData['text_state'] = '0';
        $rowData['watermark_state'] = '0';
        $rowDataSize = [];

        return view('admin.appCore.photo_filter.form', compact('pageData', 'rowData', 'rowDataSize'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $rowData = UploadFilter::findOrFail($id);
        $rowDataSize = UploadFilterSize::where('filter_id', $id)->get();
        return view('admin.appCore.photo_filter.form', compact('pageData', 'rowData', 'rowDataSize'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UploadFilterRequest $request, $id) {

        $request['convert_state'] = (isset($request->convert_state)) ? 1 : 0;
        $request['greyscale'] = (isset($request->greyscale)) ? 1 : 0;
        $request['flip_state'] = (isset($request->flip_state)) ? 1 : 0;
        $request['flip_v'] = (isset($request->flip_v)) ? 1 : 0;
        $request['blur'] = (isset($request->blur)) ? 1 : 0;
        $request['pixelate'] = (isset($request->pixelate)) ? 1 : 0;

        $saveData = UploadFilter::findOrNew($id);

        $saveData->name = $request->name;
        $saveData->type = $request->type;
        $saveData->new_w = $request->new_w;
        $saveData->new_h = $request->new_h;
        $saveData->canvas_back = $request->canvas_back;
        $saveData->convert_state = $request->convert_state;
        $saveData->quality_val = $request->quality_val;

        $saveData->greyscale = $request->greyscale;
        $saveData->flip_state = $request->flip_state;
        $saveData->flip_v = $request->flip_v;
        $saveData->blur = $request->blur;
        $saveData->blur_size = $request->blur_size;
        $saveData->pixelate = $request->pixelate;
        $saveData->pixelate_size = $request->pixelate_size;

        $saveData->text_state = $request->text_state;
        $saveData->text_print = $request->text_print;
        $saveData->font_size = $request->font_size;
        $saveData->font_path = $request->font_path;
        $saveData->font_color = $request->font_color;
        $saveData->font_opacity = $request->font_opacity;
        $saveData->text_position = $request->text_position;

        $saveData->watermark_state = $request->watermark_state;
        $saveData->watermark_img = $request->watermark_img;
        $saveData->watermark_position = $request->watermark_position;

        foreach (config('app.admin_lang') as $key => $lang) {
            $SaveName = "notes_" . $key;
            $saveData->$SaveName = $request->$SaveName;
        }

        $saveData->save();
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

}
