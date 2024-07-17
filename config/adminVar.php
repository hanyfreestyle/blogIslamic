<?php

return [

    "fontFileList" => glob("assets/admin/intervention/font/*.ttf"),
    "logoFileList" => glob('assets/admin/intervention/watermark/*.png'),

    "textPositionArr" => [
        "1"=> ['id'=>'top','name'=>"Top"],
        "2"=> ['id'=>'center','name'=>"Center"],
        "3"=> ['id'=>'bottom','name'=>"Bottom"],
    ],

    "watermarkPositionArr" => [
        "1"=> ['id'=>'top-left','name'=>"Top Left"],
        "2"=> ['id'=>'top','name'=>"Top"],
        "3"=> ['id'=>'top-right','name'=>"Top Right"],
        "4"=> ['id'=>'left','name'=>"Left"],
        "5"=> ['id'=>'center','name'=>"Center"],
        "6"=> ['id'=>'right','name'=>"Right"],
        "7"=> ['id'=>'bottom-left','name'=>"Bottom Left"],
        "8"=> ['id'=>'bottom','name'=>"Bottom"],
        "9"=> ['id'=>'bottom-right','name'=>"Bottom Right"],
    ],

];
