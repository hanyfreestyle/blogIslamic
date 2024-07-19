<?php

namespace App\View\Components\AppPlugin\Blog;


use App\AppPlugin\BlogPost\Models\Blog;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class ChartMonth extends Component {


    public function __construct() {

    }

    public function render(): View|Closure|string {

        $data = array();
        $allCount = 0;

        $monthList = "";
        $monthCountList = "";

//        $count = Blog::query()->get()->groupBy('created_at');
//dd($count);

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::today()->startOfMonth()->subMonth($i);

            $year = Carbon::today()->startOfMonth()->subMonth($i)->format('Y');
      //    dd($month);


            $count = Blog::query()->whereMonth('created_at', $month)->whereYear('created_at',$year)->count();
            $count = Blog::query()
                ->where('is_active',1)
                ->whereMonth('created_at', $month)->whereYear('created_at',$year)->count();
            $allCount = $allCount + $count;

            if ($i == 0) {
                $monthList .= "'" . $month->shortMonthName . "'";
                $monthCountList .= $count;
            } else {
                $monthList .= "'" . $month->shortMonthName . "'" . ",";
                $monthCountList .= $count . ",";
            }


            array_push($data, array(
                'month' => $month->shortMonthName,
                'year' => $year,
                'count' => $count
            ));

//            dd($data);


        }

//        dd($allCount);

        return view('components.app-plugin.blog.chart-month')->with([
            'monthList' => $monthList,
            'monthCountList' => $monthCountList,
            'allCount' => $allCount,
        ]);


    }
}
