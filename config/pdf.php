<?php

return [

    'mainConfig' => [
        'mode'                 => 'UTF-8',
        'format'               => 'A4',
        'default_font_size'    => '13',
        'default_font'         => 'sans-serif',
        'custom_font_path'     => base_path('/resources/fonts/'), // don't forget the trailing slash!
        'direction'            => 'ltr',
        'margin_left'          => 10,
        'margin_right'         => 10,
        'margin_top'           => 10,
        'margin_bottom'        => 10,
        'margin_header'        => 0,
        'margin_footer'        => 0,
        'orientation'          => 'P',
        'title'                => 'PDF',
        'author'               => '',
        'watermark'            => 'Realestate.eg',
        'show_watermark'       => true,
        'watermark_font'       => 'sans-serif',
        'display_mode'         => 'fullpage',
        'watermark_text_alpha' => 0.1,
    ],

    'arFont' => [
        'Rubik' => [
            'R' => 'ar-Rubik-Bold.ttf',
            'B' => 'ar-Rubik-Bold.ttf',
            'I' => 'ar-Rubik-Bold.ttf',
            'BI' => 'ar-Rubik-Bold.ttf',
        ],
        'Tajawal' => [
            'R' => 'ar-TajawalRegular.ttf',
            'B' => 'ar-TajawalRegular.ttf',
            'I' => 'ar-TajawalRegular.ttf',
            'BI' => 'ar-TajawalRegular.ttf',
        ],
    ],

    'enFont' => [
        'Anton' => [
            'R' => 'en-Anton-Regular.ttf',
            'B' => 'en-Anton-Regular.ttf',
            'I' => 'en-Anton-Regular.ttf',
            'BI' => 'en-Anton-Regular.ttf',
        ],
        'Ubuntu' => [
            'R' => 'en-Ubuntu-Regular.ttf',
            'B' => 'en-Ubuntu-Regular.ttf',
            'I' => 'en-Ubuntu-Regular.ttf',
            'BI' => 'en-Ubuntu-Regular.ttf',
        ]
    ],





];
