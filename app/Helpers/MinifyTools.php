<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MinifyTools {

    public $setWebAssets ;
    public $reBuild ;

    public function __construct(
        $setWebAssets = 'assets/web/',

    )
    {
        $this->setWebAssets = $setWebAssets ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     setnewFileName
    public function setWebAssets($setWebAssets){
        $this->setWebAssets = $setWebAssets;
        return $this ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function MinifyJs($url,$type='Seo',$reBuild=false){
        $filePath = public_path($this->setWebAssets.$url) ;
        if(file_exists($filePath)){
            $fileUrl =  app('url')->asset($this->setWebAssets . $url);
            $minifName = self::createMinifyJsFile($filePath,$reBuild);
            $minifUrl = self::createMinifyUrl($filePath,$url) ;

            if($type == 'Web'){
                return '<script src="'.$fileUrl .'"></script>';
            }elseif ($type == 'SeoWeb'){
                $content = file_get_contents($filePath);
                return  '<script>'.$content.'</script>' ;
            }elseif($type == 'WebMini'){
                return '<script src="'.$minifUrl .'"></script>';
            }elseif ($type == 'Seo'){
                $content = file_get_contents($minifName);
                return '<script>' . $content . '</script>';
            }
        }else{
            abort(411);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   createMinifyCSS
    public function createMinifyJsFile($filePath,$reBuild){
        $fileDir = File::dirname($filePath);
        $fileName = File::basename($filePath);

        $minifyDir = $fileDir."/min" ;
        $minifName = $minifyDir."/".$fileName;

        if(!File::isDirectory($minifyDir)){
            File::makeDirectory($minifyDir, 0777, true, true);
            File::put($minifyDir."/.gitignore","*"."\n"."!.gitignore");
        }

        if(!file_exists($minifName) or $reBuild == true ){
            $content = file_get_contents($filePath);
            $content = self::compress_js($content);
            File::put($minifName,$content);
        }

        return $minifName ;
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function MinifyCss($url,$type='Seo',$reBuild=false){
        $filePath = public_path($this->setWebAssets.$url) ;
//        dd($filePath);
        if(file_exists($filePath)){
            $fileUrl =  app('url')->asset($this->setWebAssets . $url);

            $minifName = self::createMinifyCSSFile($filePath,$reBuild);
            $minifUrl = self::createMinifyUrl($filePath,$url) ;

            if($type == 'Web'){
                return '<link rel="stylesheet" href="' . $fileUrl . '">';
            }elseif($type == 'WebMini'){
                return '<link rel="stylesheet" href="' . $minifUrl . '">';
            }elseif ($type == 'Seo'){
                $content = file_get_contents($minifName);
                return  '<style>'.$content.'</style>' ;
            }
        }else{
            abort(411);
        }
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   createMinifyCSS
    public function createMinifyCSSFile($filePath,$reBuild){
        $fileDir = File::dirname($filePath);
        $fileName = File::basename($filePath);

        $minifyDir = $fileDir."/min" ;
        $minifName = $minifyDir."/".$fileName;

        if(!File::isDirectory($minifyDir)){
            File::makeDirectory($minifyDir, 0777, true, true);
            File::put($minifyDir."/.gitignore","*"."\n"."!.gitignore");
        }

        if(!file_exists($minifName) or $reBuild == true ){
            $content = file_get_contents($filePath);
            $content = self::replacePath($content);
            $content = self::compress_css($content);
            File::put($minifName,$content);
        }

        return $minifName ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #    createMinifyUrl
    public function createMinifyUrl($filePath,$url){
        $fileName = File::basename($filePath);
        $newName = str_replace($fileName,'min/'.$fileName,$url);
        return  app('url')->asset($this->setWebAssets . $newName);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function replacePath($content){
        $WebAssets = app('url')->asset($this->setWebAssets);
        $search = [
            "../img/flags.webp?1",
            "../img/flags@2x.webp?1",
            "../img/error.svg",
//            "../images/svg/lds-sw.svg",
            "../images/",
        ];
        $replace = [
            $WebAssets."/intlTelInput/img/flags.webp?1",
            $WebAssets."/intlTelInput/img/flags@2x.webp?1",
            $WebAssets."/img/error.svg",
//            $WebAssets."/images/svg/lds-sw.svg",
             $WebAssets."/images/",
        ];
        $content =  str_replace($search,$replace,$content);
        return $content ;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    protected function insertSemicolon($value){
        return preg_replace([
            '#^[A-Za-z\s\-]+:.+(?<!({|}|;))$#m',
            '#^([A-Za-z\s\-]+):(.+)[;]$(\n+|\s+){#m',
        ], [
            '$0;',
            '$1:$2$3{',
        ], $value);
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  replace
    public function compress_css($value, $allowInsertSemicolon = true){
        if ($allowInsertSemicolon) {
            $value = $this->insertSemicolon($value);
        }

        return trim(preg_replace([
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',            //
        ], [
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2',
        ], $value));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # compress_js
    public function compress_js($input) {
        if(trim($input) === "") return $input;
        return preg_replace(
            array(
                // Remove comment(s)
                '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
                // Remove white-space(s) outside the string and regex
                '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
                // Remove the last semicolon
                '#;+\}#',
                // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
                '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
                // --ibid. From `foo['bar']` to `foo.bar`
                '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
            ),
            array(
                '$1',
                '$1$2',
                '}',
                '$1$3',
                '$1.$3'
            ),
            $input);
    }


}
