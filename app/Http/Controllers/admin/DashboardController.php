<?php

namespace App\Http\Controllers\admin;

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
        return view('admin.dashbord')->with([


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
