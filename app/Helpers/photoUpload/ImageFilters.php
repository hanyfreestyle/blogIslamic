<?php
namespace App\Helpers\photoUpload;
use App\Helpers\AdminHelper;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;


class ImageFilters implements FilterInterface
{

    private $filterData;

    public function __construct($filterData)
    {
        $this->filterData = $filterData;

    }


    public function applyFilter(Image $image){

        //$FilterOption = UploadFilter::find($this->filterId);

        $FilterOption = $this->filterData;
        $newWidth =$FilterOption->new_w;
        $newHeight = $FilterOption->new_h;
        $filterType = $FilterOption->type;

        if($filterType == "1"){
                $hany = "11";
        }elseif ($filterType == "2"){
            $image->widen($newWidth, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($filterType == "3"){
            $image->heighten($newHeight, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($filterType == "4"){
            $image->fit($newWidth, $newHeight, function ($constraint) {
                $constraint->upsize();
            });
        }elseif ($filterType == "5"){
            $image->resize($newWidth, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->resizeCanvas($newWidth, $newHeight, 'center', false, $FilterOption->canvas_back);
        }

        if(intval($FilterOption->flip_state) == '1'){
            $image->flip();
        }

        if(intval($FilterOption->flip_v) == '1'){
            $image->flip('v');
        }


        if(intval($FilterOption->text_state) != '0'){
            $height = $image->height();
            $width = $image->width();
            $txt = $FilterOption->text_print;
            $text_x = $width / 2 ;
            if($FilterOption->text_position == "top"){
                $text_y = 30;
            }elseif ($FilterOption->text_position == "center"){
                $text_y = $height/2;
            }elseif ($FilterOption->text_position == "bottom"){
                $text_y = $height-20;
            }
            $opacity = ($FilterOption->font_opacity/100);
            $fontGetColor = AdminHelper::hex2rgb($FilterOption->font_color,$opacity);

            $image->text($txt, $text_x, $text_y, function($font) use($FilterOption,$fontGetColor){
               // dd(public_path($FilterOption->font_path));
               // dd($FilterOption->font_path);
                $font->file(public_path($FilterOption->font_path));
                $font->size($FilterOption->font_size);
                $font->color($fontGetColor);
                $font->align('center');
            });
        }


        if(intval($FilterOption->watermark_state) != '0' ){

            $watermark_img =  file_exists ( $FilterOption->watermark_img );
            if($watermark_img){

                if($FilterOption->watermark_position == 'center'){
                    $newWidth = $image->width()-100;
                    $newHeight = $image->height()-50;
                }else{
                    $newHeight =intval( $image->height() / 8);

                }

                $watermark = AdminHelper::getImageWatermark($FilterOption->watermark_img);

                if($FilterOption->watermark_position == 'center') {
                    $watermark->widen($newWidth, function ($constraint) {
                        $constraint->upsize();
                    });
                    $watermark->heighten($newHeight, function ($constraint) {
                        $constraint->upsize();
                    });
                }else{
                    $watermark->heighten($newHeight, function ($constraint) {
                        $constraint->upsize();
                    });
                }

                $image->insert($watermark, $FilterOption->watermark_position, 10, 10);

            }

        }

        if(intval($FilterOption->blur) != '0' and intval($FilterOption->blur_size) != '0'){
            $image->blur($FilterOption->blur_size);
        }

        if($FilterOption->greyscale == '1'){
            $image->greyscale();
        }

        return $image ;
    }
}
