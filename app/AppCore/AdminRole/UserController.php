<?php


namespace App\AppCore\AdminRole;

use App\AppCore\AdminRole\Request\UserRequest;
use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends AdminMainController {

    use CrudTraits;

    function __construct(User $model) {

        parent::__construct();
        $this->controllerName = "UserList";
        $this->PrefixRole = 'users';
        $this->selMenu = "admin.users.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/roles.users_title');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ['filterid' => 0],
            'restore' => 1,
        ];
        self::loadConstructData($sendArr);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = User::onlyTrashed()->count();

        $users = self::getSelectQuery(User::where('id', '!=', 0));
        $roles = Role::all();
        return view('admin.appCore.role.user_index', compact('pageData', 'users', 'roles'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $roles = array();
        $users = self::getSelectQuery(User::onlyTrashed());
        return view('admin.appCore.role.user_index', compact('pageData', 'users', 'roles'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $pageData['passReq'] = true;
        $users = User::findOrNew(0);
        $roles = Role::all();
        return view('admin.appCore.role.user_form', compact('pageData', 'users', 'roles'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['passReq'] = false;
        $pageData['ViewType'] = "Edit";

        $users = User::findOrFail($id);
        $roles = Role::all();
        $userRole = $users->roles->pluck('name', 'id')->all();
        return view('admin.appCore.role.user_form', compact('users', 'pageData', 'roles', 'userRole'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(UserRequest $request, $id = 0) {

        $saveData = User::findOrNew($id);
        $saveData->name = $request->name;
        $saveData->email = $request->email;
        $saveData->phone = $request->phone;
        $saveData->slug = AdminHelper::Url_Slug($request->slug);
        $saveData->des = $request->des;

        if (trim($request->user_password != '')) {
            $saveData->password = Hash::make($request->user_password);
        }

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setUploadDirIs('user-profile')->setnewFileName($request->input('name'));

        $saveImgData->UploadOneNofilter($request, '4', 300, 300);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData, 'photo');

        $saveImgData->UploadOneNofilter($request, '4', 100, 100);
        $saveData = AdminHelper::saveAndDeletePhotoByOne($saveData, $saveImgData, 'photo_thum_1');


        $saveData->roles_name = $request->input('roles');
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $saveData->assignRole($request->input('roles'));

        $saveData->save();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        if ($id != '1') {
            $deleteRow = User::findOrFail($id);
            $deleteRow->delete();
            return redirect(route($this->PrefixRoute . '.index'))->with('confirmDelete', "");
        } else {
            return back();
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  updateStatus
    public function updateStatus(Request $request) {
        $userId = $request->send_id;
        if ($userId != '1') {
            $updateData = User::findOrFail($userId);
            if ($updateData->status == '1') {
                $updateData->status = '0';
            } else {
                $updateData->status = '1';
            }
            $updateData->save();
            return response()->json(['success' => $userId]);
        }
    }

}



