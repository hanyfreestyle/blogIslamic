<?php

namespace App\AppCore\AdminRole;

use App\AppCore\AdminRole\Request\AdminPermissionRequest;
use App\AppCore\Menu\AdminMenu;
use App\Http\Controllers\AdminMainController;

use App\Http\Traits\CrudTraits;
use Spatie\Permission\Models\Permission;


class PermissionController extends AdminMainController {
    use CrudTraits;


    function __construct() {
        if (config('app.development')) {
            $stopAdd = '';
        } else {
            $stopAdd = 'stop';
        }

        parent::__construct();
        $this->controllerName = "permissions";
        $this->PrefixRole = 'roles';
        $this->selMenu = "admin.users.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/roles.users_title');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ['filterid' => 0],
        ];

        self::loadConstructData($sendArr);

        $this->middleware('permission:' . $this->PrefixRole . '_add' . $stopAdd, ['only' => ['create']]);
        $this->middleware('permission:' . $this->PrefixRole . '_delete' . $stopAdd, ['only' => ['destroy']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $permissions = self::getSelectQuery(Permission::where('id', '!=', 0));
        return view('admin.appCore.role.permission_index', compact('pageData', 'permissions'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $permission = Permission::findOrNew(0);
        return view('admin.appCore.role.permission_form', compact('pageData', 'permission'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $permission = Permission::findOrFail($id);
        return view('admin.appCore.role.permission_form', compact('permission', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(AdminPermissionRequest $request, $id = 0) {
        $request->validated();
        $saveData = Permission::findOrNew($id);
        $saveData->name = $request->name;
        $saveData->name_ar = $request->name_ar;
        $saveData->name_en = $request->name_en;
//        $saveData->cat_id =  $request->cat_id;
        $saveData->save();
        if ($id == '0') {
            return redirect(route('admin.users.permissions.index'))->with('Add.Done', "");
        } else {
            return redirect(route('admin.users.permissions.index'))->with('Edit.Done', "");
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id) {
        $deleteRow = Permission::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('admin.users.permissions.index'))->with('confirmDelete', "");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.users";
        $mainMenu->name = "admin/config/roles.menu_roles";
        $mainMenu->icon = "fas fa-unlock-alt";
        $mainMenu->roleView = "users_view";
        $mainMenu->postion = 99;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "UserList.index";
        $subMenu->url = "admin.users.UserList.index";
        $subMenu->name = "admin/config/roles.menu_roles_users";
        $subMenu->roleView = "users_view";
        $subMenu->icon = "fas fa-users";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "roles.index";
        $subMenu->url = "admin.users.roles.index";
        $subMenu->name = "admin/config/roles.menu_roles_role";
        $subMenu->roleView = "roles_view";
        $subMenu->icon = "fas fa-traffic-light";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "permissions.index";
        $subMenu->url = "admin.users.permissions.index";
        $subMenu->name = "admin/config/roles.menu_roles_permissions";
        $subMenu->roleView = "roles_view";
        $subMenu->icon = "fas fa-user-shield";
        $subMenu->save();

    }
}
