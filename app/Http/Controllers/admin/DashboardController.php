<?php

namespace App\Http\Controllers\admin;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\Orders\Models\Order;
use App\AppPlugin\Product\Models\Brand;
use App\AppPlugin\Product\Models\Category;
use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\AdminMainController;
use App\Helpers\PDF;
use Illuminate\Support\Facades\Session;


class DashboardController extends AdminMainController {

public function ChangeCollapse(){
    $session = Session::get('sidebarCollapse');
    if($session == null){
        Session::put("sidebarCollapse", 'sidebar-collapse sidebar-mini');
        Session::save();
    }else{
        Session::forget('sidebarCollapse');
    }
    return redirect()->back();
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function Dashboard() {
        $blog_count = Blog::query();
        $blog_cat_count = BlogCategory::query()->count();
        $card = [];

        $card['blog_count'] = $blog_count->count();
        $card['blog_count_active'] = $blog_count->where('is_active',1)->count();
        $card['blog_count_unactive'] = Blog::query()->where('is_active',0)->count();
        $card['blog_cat_count'] = $blog_cat_count;


        return view('admin.dashbord')->with([
            'card' => $card,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function testpdf() {
        $pdf = new PDF();
        $data = [
            'foo' => 'bar'
        ];
        $pdf->addArCustomFont();
        $pdf->addEnCustomFont();
        $pdf->loadView('pdf.test', $data);
        //$pdf->SetProtection(['copy', 'print'], 'user_pass', 'owner_pass');
        return $pdf->stream('document.pdf');
        // return $pdf->download("hany.pdf");
    }







}
