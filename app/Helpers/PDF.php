<?php
namespace App\Helpers;


use Config;
use Exception;
use File;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Mpdf\Utils\UtfString;
use View;


class PDF extends Mpdf {
    protected $config = [];

    public function __construct($configs = []){
        $config = Config::get('pdf.mainConfig');

        if (!$config) {
            $config = [];
        }

        $this->config = array_merge($config, $configs);
        parent::__construct([
                'mode' => $this->getConfig('mode'), // mode - default ''
                'format' => $this->getConfig('format'), // format - A4, for example, default ''
                'default_font_size' => $this->getConfig('default_font_size'),// font size - default 0
                'default_font' => $this->getConfig('default_font'), // default font family
                'margin_left' => $this->getConfig('margin_left'), // margin_left
                'margin_right' => $this->getConfig('margin_right'), // margin right
                'margin_top' => $this->getConfig('margin_top'), // margin top
                'margin_bottom' => $this->getConfig('margin_bottom'), // margin bottom
                'margin_header' => $this->getConfig('margin_header'), // margin header
                'margin_footer' => $this->getConfig('margin_footer'), // margin footer
                'orientation' => $this->getConfig('orientation'), // L - landscape, P - portrait
            ]
        );

        $font_data = [];
        if (is_array($font_data)) {
            $this->fontdata = array_merge($this->fontdata, $font_data);

            foreach ($font_data as $f => $fs) {
                if (isset($fs['R']) && $fs['R']) {
                    $this->available_unifonts[] = $f;
                }
                if (isset($fs['B']) && $fs['B']) {
                    $this->available_unifonts[] = $f . 'B';
                }
                if (isset($fs['I']) && $fs['I']) {
                    $this->available_unifonts[] = $f . 'I';
                }
                if (isset($fs['BI']) && $fs['BI']) {
                    $this->available_unifonts[] = $f . 'BI';
                }
            }

            $this->default_available_fonts = $this->available_unifonts;
        }

        $this->SetTitle($this->getConfig('title'));
        $this->SetAuthor($this->getConfig('author'));

        $this->SetWatermarkText($this->getConfig('watermark'));
        $this->SetDisplayMode($this->getConfig('display_mode'));
        $this->SetDirectionality($this->getConfig('dir') ? $this->getConfig('dir') : $this->getConfig('direction'));
        $this->showWatermarkText = $this->getConfig('show_watermark');
        $this->watermark_font = $this->getConfig('watermark_font');
        $this->watermarkTextAlpha = $this->getConfig('watermark_text_alpha');

        if (Config::has('pdf.custom_font_path') && Config::get('pdf.custom_font_path')) {
            $this->AddFontDirectory(Config::get('pdf.custom_font_path'));
        }

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function Make()
    {
        return $this;
    }

    public function SetDirection($dir)
    {
        $this->SetDirectionality($dir);

        return $this;
    }

    public function loadHTML($html)
    {
        $wm = UtfString::strcode2utf($html);

        $this->WriteHTML($wm);
    }

    public function loadFile($file, $config = [])
    {
        $this->WriteHTML(File::get($file));
    }

    public function loadView($view, $data = [], $mergeData = [])
    {
        $this->WriteHTML(View::make($view, $data, $mergeData)->render());
    }

    public function embed($name = 'document.pdf')
    {
        return $this->Output($name, Destination::STRING_RETURN);
    }

    public function save($filename = 'document.pdf')
    {
        return $this->Output($filename, Destination::STRING_RETURN);
    }

    public function download($filename = 'document.pdf')
    {
        return $this->Output($filename, Destination::DOWNLOAD);
    }

    public function stream($filename = 'document.pdf')
    {
        return $this->Output($filename, Destination::INLINE);
    }

    protected function getConfig($key){
        if (isset($this->config[$key])) {
            return $this->config[$key];
        } else {
            return Config::get('pdf.' . $key);
        }
    }


    public function addArCustomFont(){
        $fonts_list = $this->getConfig('arFont');
        $this->addCustomFont($fonts_list,true);
    }

    public function addEnCustomFont(){
        $fonts_list = $this->getConfig('enFont');
        $this->addCustomFont($fonts_list,false);
    }

    public function addCustomFont($fonts_list,$unicode){

        $custom_font_path = $this->getConfig('custom_font_path');

        if($fonts_list != null){

            if (empty($fonts_list)) {
                throw new Exception('Please add font data in EmbedFont() function.');
            }


            if (!$custom_font_path) {
                throw new Exception('custom_font_path not set in "config/pdf.php" file.');
            } else {
                $custom_font_path = rtrim($custom_font_path, '/');
            }

            foreach ($fonts_list as $f => $fs) {
                if (is_array($fs)) {
                    foreach (['R', 'B', 'I', 'BI'] as $style) {
                        if (isset($fs[$style]) && $fs[$style]) {
                            $font = $fs[$style];
                            $font_file = $custom_font_path . '/' . $font;

                            if (!file_exists(base_path('vendor/mpdf/mpdf/ttfonts/' . $font))) {
                                if (file_exists($font_file)) {
                                    File::copy($font_file, base_path('vendor/mpdf/mpdf/ttfonts/' . $font));
                                } else {
                                    throw new Exception('Your font file "' . $font_file . '" not exist.');
                                }
                            }
                        }
                    }
                }
            }
            $this->addFontData($fonts_list,$unicode);
        }
    }


    protected function addFontData($fonts, $unicode = false){
        foreach ($fonts as $key => $val) {
            $key = strtolower($key);
            if (is_array($val)) {

                foreach (['R', 'B', 'I', 'BI'] as $style) {
                    if (isset($val[$style]) && $val[$style]) {
                        $font = $val[$style];
                        $this->available_unifonts[] = $key . trim($style, 'R');
                    }
                }
                if ($unicode) {
                    $val['useKashida'] = 75;
                    $val['useOTL'] = 0xFF;
                }
                $font_data[$key] = $val;

                $this->fontdata[$key] = $val;
            }
        }

        $this->default_available_fonts = $this->available_unifonts;
    }

    protected function array2str($arr)
    {
        $retStr = '';
        if (is_array($arr)) {
            $retStr .= "[ \r";
            foreach ($arr as $key => $val) {
                if (is_array($val)) {
                    $retStr .= "\t'" . $key . "' => " . $this->array2str($val) . ",\r";
                } else {
                    if (is_string($val)) {
                        $retStr .= "\t'" . $key . "' => '" . $val . "',\r";
                    } else {
                        $retStr .= "\t'" . $key . "' => " . ($key == 'useOTL' ? '0xFF' : $val) . ",\r";
                    }
                }
            }
            $retStr .= " ]";
        }

        return $retStr;
    }

}
