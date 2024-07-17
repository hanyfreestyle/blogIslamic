<?php

namespace App\AppPlugin\AppPuzzle;


use App\AppCore\Menu\AdminMenu;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


class AppPuzzleController extends AppPuzzleFun {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   IndexModel
    public function IndexPuzzle() {
        $selRoute = null;

        if (config('app.puzzle_active') == false){
            return abort(403);
        }

        if (Route::currentRouteName() == 'admin.AppPuzzle.Config.IndexModel') {
            $rowData = AppPuzzleTreeConfig::ConfigTree();
            $selRoute = "Config";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Model.IndexModel') {
            $rowData = AppPuzzleTreeModel::ModelTree();
            $selRoute = "Model";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Data.IndexModel') {
            $rowData = AppPuzzleTreeData::DataTree();
            $selRoute = "Data";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Leads.IndexModel') {
            $rowData = AppPuzzleTreeLeads::LeadsTree();
            $selRoute = "Leads";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Product.IndexModel') {
            $rowData = AppPuzzleTreeProduct::ProductTree();
            $selRoute = "Product";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.Crm.IndexModel') {
            $rowData = AppPuzzleTreeCrm::CrmTree();
            $selRoute = "Crm";
        } elseif (Route::currentRouteName() == 'admin.AppPuzzle.AppCore.IndexModel') {
            $rowData = AppPuzzleTreeAppCore::AppCore();
            $selRoute = "AppCore";
            return view('AppPlugin.AppPuzzle.index_core')->with([
                'rowData' => $rowData,
                'selRoute' => $selRoute,
            ]);
        }

        return view('AppPlugin.AppPuzzle.index_model')->with([
            'rowData' => $rowData,
            'selRoute' => $selRoute,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   LoadTreeData
    public function LoadTreeData() {
        $Config = AppPuzzleTreeConfig::ConfigTree();
        $Model = AppPuzzleTreeModel::ModelTree();
        $Data = AppPuzzleTreeData::DataTree();
        $Leads = AppPuzzleTreeLeads::LeadsTree();
        $Product = AppPuzzleTreeProduct::ProductTree();
        $Crm = AppPuzzleTreeCrm::CrmTree();
        $AppCore = AppPuzzleTreeAppCore::AppCore();
        $treeData = $Config + $Model + $Data + $Leads + $Product + $Crm + $AppCore;
        return $treeData;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CopyModel
    public function CopyModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $copy = new AppPuzzleFunCopy();

            $copy->copyAppFolder($thisModel);
            $copy->copyViewFolder($thisModel);
            $copy->copyRouteFile($thisModel);
            $copy->copyMigrations($thisModel);
            $copy->copyLangFile($thisModel);
            $copy->copyPhotoFolder($thisModel);
            $copy->copyAssetsFolder($thisModel);
            $copy->copyComponentFolder($thisModel);
            $copy->copyComponentFile($thisModel);
            $copy->copyLivewireFile($thisModel);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # RemoveModel
    public function RemoveModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $remove = new AppPuzzleFunRemove();

            $remove->removeAppFolder($thisModel);
            $remove->removeViewFolder($thisModel);
            $remove->removeRouteFile($thisModel);
            $remove->removeMigrations($thisModel);
            $remove->removeLangFiles($thisModel);
            $remove->removePhotoFolder($thisModel);
            $remove->removeAssetsFolder($thisModel);
            $remove->removeComponentFolder($thisModel);
            $remove->removeComponentFile($thisModel);
            $remove->removeLivewireFile($thisModel);

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ImportModel
    public function ImportModel($model) {

        $modelTree = self::LoadTreeData();

        if (isset($modelTree[$model])) {
            $thisModel = $modelTree[$model];
            $BackFolder = $this->mainFolder . $thisModel['CopyFolder'];
            $destinationFolder = base_path();
            if (File::isDirectory($BackFolder)) {
                self::recursive_files_copy($BackFolder, $destinationFolder);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AdminMenu
    static function AdminMenu() {

        $role = 'adminlang_view';
        $PrefixRoute = "admin.AppPuzzle.";

        $mainMenu = new AdminMenu();
        $mainMenu->type = "Many";
        $mainMenu->sel_routs = "admin.AppPuzzle";
        $mainMenu->name = "App Puzzle";
        $mainMenu->icon = "fas fa-puzzle-piece";
        $mainMenu->roleView = $role;
        $mainMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Config.IndexModel";
        $subMenu->url = $PrefixRoute . "Config.IndexModel";
        $subMenu->name = "Config";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Model.IndexModel";
        $subMenu->url = $PrefixRoute . "Model.IndexModel";
        $subMenu->name = "Model";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Product.IndexModel";
        $subMenu->url = $PrefixRoute . "Product.IndexModel";
        $subMenu->name = "Product";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Data.IndexModel";
        $subMenu->url = $PrefixRoute . "Data.IndexModel";
        $subMenu->name = "Data";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Leads.IndexModel";
        $subMenu->url = $PrefixRoute . "Leads.IndexModel";
        $subMenu->name = "Leads";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();

        $subMenu = new AdminMenu();
        $subMenu->parent_id = $mainMenu->id;
        $subMenu->sel_routs = "Crm.IndexModel";
        $subMenu->url = $PrefixRoute . "Crm.IndexModel";
        $subMenu->name = "Crm";
        $subMenu->roleView = $role;
        $subMenu->icon = "fas fa-list";
        $subMenu->save();
    }
}
