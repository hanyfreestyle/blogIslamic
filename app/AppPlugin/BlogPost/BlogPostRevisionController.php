<?php

namespace App\AppPlugin\BlogPost;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\Http\Controllers\AdminMainController;
use Illuminate\Support\Facades\View;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Renderer\RendererConstant;


class BlogPostRevisionController extends AdminMainController {

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogPost";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_blog');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'yajraTable' => true,
            'AddLang' => true,
            'AddMorePhoto' => true,
            'restore' => 1,
        ];

        self::loadConstructData($sendArr);
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #

    public function ListRevision($id) {

        $oldData = BlogReview::where('id', $id)->firstOrFail();



        $AllData = BlogReview::where('blog_id', $oldData->blog_id)->get();
        $oldHtml = $oldData->des ?? '';
        $loop = $oldData->loop_index;




        if ($loop == count($AllData)) {
            $newData = Blog::where('id', $oldData->blog_id)->firstOrFail();
            $canUpdate = false;
        } else {
            $newData = BlogReview::where('blog_id', $oldData->blog_id)
                ->where('loop_index', $loop + 1)
                ->firstOrFail();
            $canUpdate = true;
        }
        $newHtml = $newData->des;

        $config = self::HtmlConfig();
        $diffOptions = $config['diffOptions'];
        $rendererOptions = $config['rendererOptions'];

        $sideBySideResult = DiffHelper::calculate(
            $oldHtml,
            $newHtml,
            'SideBySide',
            $diffOptions,
            $rendererOptions,
        );

        return view('AppPlugin.BlogPost.revision')->with([
            'sideBySideResult' => $sideBySideResult,
            'AllData' => $AllData,
            'oldData' => $oldData,
            'canUpdate' => $canUpdate,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function HtmlConfig() {

        // options for Diff class
        $diffOptions = [
            // show how many neighbor lines
            // Differ::CONTEXT_ALL can be used to show the whole file
            'context' => 3000,
            // ignore case difference
            'ignoreCase' => true,
            // ignore line ending difference
            'ignoreLineEnding' => true,
            // ignore whitespace difference
            'ignoreWhitespace' => true,
            // if the input sequence is too long, it will just gives up (especially for char-level diff)
            'lengthLimit' => 20000000000,
            // if truthy, when inputs are identical, the whole inputs will be rendered in the output
            'fullContextIfIdentical' => true,
        ];

// options for renderer class
        $rendererOptions = [
            // how detailed the rendered HTML is? (none, line, word, char)
            'detailLevel' => 'line',
            // renderer language: eng, cht, chs, jpn, ...
            // or an array which has the same keys with a language file
            // check the "Custom Language" section in the readme for more advanced usage
            'language' => [
                // use English as the base language
                'eng',
                // your custom overrides
                [
                    // use "Diff" as the new value of the "differences" key
                    "old_version" => "المحتوى السابق",
                    "new_version" => "المحتوى الحالى",
                    "differences" => "Differences"
                ],
                // maybe more overrides if you somehow need them...
            ],
            // show line numbers in HTML renderers
            'lineNumbers' => true,
            // show a separator between different diff hunks in HTML renderers
            'separateBlock' => false,
            // show the (table) header
            'showHeader' => true,
            // convert spaces/tabs into HTML codes like `<span class="ch sp"> </span>`
            // and the frontend is responsible for rendering them with CSS.
            // when using this, "spacesToNbsp" should be false and "tabSize" is not respected.
            'spaceToHtmlTag' => true,
            // the frontend HTML could use CSS "white-space: pre;" to visualize consecutive whitespaces
            // but if you want to visualize them in the backend with "&nbsp;", you can set this to true
            'spacesToNbsp' => false,
            // HTML renderer tab width (negative = do not convert into spaces)
            'tabSize' => 4,
            // this option is currently only for the Combined renderer.
            // it determines whether a replace-type block should be merged or not
            // depending on the content changed ratio, which values between 0 and 1.
            'mergeThreshold' => 0,
            // this option is currently only for the Unified and the Context renderers.
            // RendererConstant::CLI_COLOR_AUTO = colorize the output if possible (default)
            // RendererConstant::CLI_COLOR_ENABLE = force to colorize the output
            // RendererConstant::CLI_COLOR_DISABLE = force not to colorize the output
            'cliColorization' => RendererConstant::CLI_COLOR_AUTO,
            // this option is currently only for the Json renderer.
            // internally, ops (tags) are all int type but this is not good for human reading.
            // set this to "true" to convert them into string form before outputting.
            'outputTagAsString' => false,
            // this option is currently only for the Json renderer.
            // it controls how the output JSON is formatted.
            // see available options on https://www.php.net/manual/en/function.json-encode.php
            'jsonEncodeFlags' => \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE,
            // this option is currently effective when the "detailLevel" is "word"
            // characters listed in this array can be used to make diff segments into a whole
            // for example, making "<del>good</del>-<del>looking</del>" into "<del>good-looking</del>"
            // this should bring better readability but set this to empty array if you do not want it
            'wordGlues' => [' ', '-'],
            // change this value to a string as the returned diff if the two input strings are identical
            'resultForIdenticals' => null,
            // extra HTML classes added to the DOM of the diff container
            'wrapperClasses' => ['diff-wrapper'],
        ];

        return ['diffOptions' => $diffOptions, 'rendererOptions' => $rendererOptions];

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ListRevision_old($id) {
        $oldData = BlogReview::where('id', $id)->firstOrFail();

        $AllData = BlogReview::where('blog_id', $oldData->blog_id)->pluck('loop_index');
        $oldHtml = $oldData->des;
        $loop = $oldData->loop_index;


        if ($loop == count($AllData)) {
            $newData = Blog::where('id', $oldData->blog_id)->firstOrFail();
        } else {
            $newData = BlogReview::where('blog_id', $oldData->blog_id)
                ->where('loop_index', $loop + 1)
                ->firstOrFail();
        }


        $newHtml = $newData->des;
//        dd($oldHtml);
//        $config = new HtmlDiffConfig();
//        $config->setMatchThreshold(80);
//
//        $htmlDiff = HtmlDiff::create($oldHtml, $newHtml, $config);
//        $content = $htmlDiff->build();

        $htmlDiff = new HtmlDiff($oldHtml, $newHtml);
//        $htmlDiff->getConfig()->setSpecialCaseChars(array('\r\n', ',', '(', ')', '\''));
//        dd($htmlDiff);

        $content = $htmlDiff->build();
//        dd($content);
        return view('AppPlugin.BlogPost.revision')->with([
            'oldHtml' => $oldHtml,
            'content' => $content,
            'AllData' => $AllData,
        ]);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function HtmlConfig_sours() {

        // options for Diff class
        $diffOptions = [
            // show how many neighbor lines
            // Differ::CONTEXT_ALL can be used to show the whole file
            'context' => 7,
            // ignore case difference
            'ignoreCase' => true,
            // ignore line ending difference
            'ignoreLineEnding' => true,
            // ignore whitespace difference
            'ignoreWhitespace' => true,
            // if the input sequence is too long, it will just gives up (especially for char-level diff)
            'lengthLimit' => 2000,
            // if truthy, when inputs are identical, the whole inputs will be rendered in the output
            'fullContextIfIdentical' => true,
        ];

// options for renderer class
        $rendererOptions = [
            // how detailed the rendered HTML is? (none, line, word, char)
            'detailLevel' => 'line',
            // renderer language: eng, cht, chs, jpn, ...
            // or an array which has the same keys with a language file
            // check the "Custom Language" section in the readme for more advanced usage
            'language' => [
                // use English as the base language
                'eng',
                // your custom overrides
                [
                    // use "Diff" as the new value of the "differences" key
                    "old_version" => "هانى",
                    "new_version" => "New",
                    "differences" => "Differences"
                ],
                // maybe more overrides if you somehow need them...
            ],
            // show line numbers in HTML renderers
            'lineNumbers' => true,
            // show a separator between different diff hunks in HTML renderers
            'separateBlock' => false,
            // show the (table) header
            'showHeader' => true,
            // convert spaces/tabs into HTML codes like `<span class="ch sp"> </span>`
            // and the frontend is responsible for rendering them with CSS.
            // when using this, "spacesToNbsp" should be false and "tabSize" is not respected.
            'spaceToHtmlTag' => true,
            // the frontend HTML could use CSS "white-space: pre;" to visualize consecutive whitespaces
            // but if you want to visualize them in the backend with "&nbsp;", you can set this to true
            'spacesToNbsp' => true,
            // HTML renderer tab width (negative = do not convert into spaces)
            'tabSize' => 4,
            // this option is currently only for the Combined renderer.
            // it determines whether a replace-type block should be merged or not
            // depending on the content changed ratio, which values between 0 and 1.
            'mergeThreshold' => 0,
            // this option is currently only for the Unified and the Context renderers.
            // RendererConstant::CLI_COLOR_AUTO = colorize the output if possible (default)
            // RendererConstant::CLI_COLOR_ENABLE = force to colorize the output
            // RendererConstant::CLI_COLOR_DISABLE = force not to colorize the output
            'cliColorization' => RendererConstant::CLI_COLOR_AUTO,
            // this option is currently only for the Json renderer.
            // internally, ops (tags) are all int type but this is not good for human reading.
            // set this to "true" to convert them into string form before outputting.
            'outputTagAsString' => false,
            // this option is currently only for the Json renderer.
            // it controls how the output JSON is formatted.
            // see available options on https://www.php.net/manual/en/function.json-encode.php
            'jsonEncodeFlags' => \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE,
            // this option is currently effective when the "detailLevel" is "word"
            // characters listed in this array can be used to make diff segments into a whole
            // for example, making "<del>good</del>-<del>looking</del>" into "<del>good-looking</del>"
            // this should bring better readability but set this to empty array if you do not want it
            'wordGlues' => [' ', '-'],
            // change this value to a string as the returned diff if the two input strings are identical
            'resultForIdenticals' => null,
            // extra HTML classes added to the DOM of the diff container
            'wrapperClasses' => ['diff-wrapper'],
        ];

        return ['diffOptions' => $diffOptions, 'rendererOptions' => $rendererOptions];

    }
}
