<?php

namespace App\AppCore\AdminRole;

use App\AppCore\AdminRole\Request\AdminRoleRequest;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends AdminMainController{
    use CrudTraits ;

    function __construct(){
        parent::__construct();
        $this->controllerName = "roles";
        $this->PrefixRole = 'users';
        $this->selMenu = "admin.users.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/config/roles.role_title');
        $this->PrefixRoute = $this->selMenu.$this->controllerName ;

        $sendArr = [
            'TitlePage' =>  $this->PageTitle ,
            'PrefixRoute'=>  $this->PrefixRoute,
            'PrefixRole'=> $this->PrefixRole ,
            'AddConfig'=> true ,
            'configArr'=> ['filterid'=>0] ,
        ];

        self::loadConstructData($sendArr);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $roles = self::getSelectQuery(Role::where('id','!=',0));
        $rolePrintName = 'name_'.thisCurrentLocale();
        return view('admin.appCore.role.role_index',compact('pageData','roles','rolePrintName'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create(){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $role = Role::findOrNew(0);
        return view('admin.appCore.role.role_form',compact('pageData','role'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $role = Role::findOrFail($id);
        return view('admin.appCore.role.role_form',compact('pageData','role'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(AdminRoleRequest $request, $id=0){
        $request-> validated();

        $saveData =  Role::findOrNew($id);
        $saveData->name = $request->name;
        $saveData->name_ar = $request->name_ar;
        $saveData->name_en = $request->name_en;
        $saveData->save();

        return  self::redirectWhere($request,$id,$this->PrefixRoute.'.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroy($id){
        $deleteRow = Role::findOrFail($id);
        $deleteRow->delete();
        return redirect(route('users.roles.index'))->with('confirmDelete',"");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     editRoleToPermission
    public function editRoleToPermission($id){
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";

        $role = Role::findOrFail($id);
        //$permissions = Permission::all();
        //$permissions = Permission::groupBy('cat_id')->get();
        //$permissions = Permission::selectRaw('cat_id','name','name_ar')->groupBy('cat_id')->get();
        $permissionsGroup = Permission::get()->groupBy('cat_id');
        return view('admin.appCore.role.role_editRoleToPermission',compact('pageData','role',"permissionsGroup"));
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     givePermission
    public function givePermission(Request $request , Role $role , Permission $permission){

        if($request->role_id != 1){
            $role_id  = $request->role_id;
            $permissionName = $request->permissionName;

            $role = Role::findOrFail($role_id);

            if($role->hasPermissionTo($permissionName)){
                $role->revokePermissionTo($permissionName);
            }else{
                $role->givePermissionTo($permissionName);
            }
            return response()->json(['role_id'=>$role->name]);
        }else{
            return response()->json(['NoChange'=>$request->permissionName]);
        }
    }

}


