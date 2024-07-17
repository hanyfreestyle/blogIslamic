<?php

namespace App\Http\Controllers\web;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\Config\Privacy\WebPrivacy;
use App\AppPlugin\Pages\Models\Page;
use App\Helpers\AdminHelper;
use App\Helpers\TableOfContents\Contents;
use App\Http\Controllers\WebMainController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class MainPagesViewController extends WebMainController {

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PagePrivacy
    public function PagePrivacy() {
        $Meta = parent::getMeatByCatId('Privacy');
        parent::printSeoMeta($Meta, 'page_index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'PagePrivacy';
        $webPrivacy = WebPrivacy::where('is_active', true)->orderby('postion', 'asc')->with('translation')->get();
        return view('web.page_privacy')->with(
            [
                'pageView' => $pageView,
                'webPrivacy' => $webPrivacy,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PageAbout
    public function PageAbout() {
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'PageAbout';
        $page = Page::where('id', 1)->with('translation')->firstOrFail();
        $Meta = parent::getMeatByCatId('AboutUs');
        parent::printSeoMeta($Meta, 'page_index');
        return view('web.page_about')->with(
            [
                'pageView' => $pageView,
                'page' => $page,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     PageReview
    public function PageReview() {
        $Meta = parent::getMeatByCatId('Review');
        parent::printSeoMeta($Meta, 'page_index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'PageReview';

        $page = Page::where('id', 2)->with('translation')->with('more_photos')->firstOrFail();

        return view('web.page_review')->with(
            [
                'pageView' => $pageView,
                'page' => $page,
            ]
        );
    }




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';

//        $categories = BlogCategory::orderby('count', "desc")->take(10)->get()->map(function ($blog) {
//            $blog->setRelation('homeBlog', $blog->homeBlog->take(3));
//            return $blog;
//        });


        $categories = BlogCategory::query()->withCount('blogs')
            ->orderby('blogs_count', "desc")
            ->having('blogs_count', '>', 0)
            ->take(10)->get()->map(function ($blog) {
                $blog->setRelation('homeBlog', $blog->homeBlog->take(3));
                return $blog;
            });

        return view('web.index')->with(
            [
                'pageView' => $pageView,
                'categories' => $categories,
            ]
        );

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     categories
    public function categories() {
        $Meta = parent::getMeatByCatId('categories');
        parent::printSeoMeta($Meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Category';

        $categories = BlogCategory::orderby('count', "desc")->paginate(12);

        return view('web.category_list')->with(
            [
                'pageView' => $pageView,
                'categories' => $categories,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function CategoryView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $category = BlogCategory::whereTranslation('slug', $slug)
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        parent::printSeoMeta($category, 'page_index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'CategoryID' . $category->id;

        $catid = $category->id;

        $blogs = Blog::defWeb()
            ->whereHas('categories', function ($query) use ($catid) {
                $query->where('category_id', $catid);
            })->orderby('created_at', 'desc')->paginate(12);

        return view('web.category_view')->with(
            [
                'pageView' => $pageView,
                'blogs' => $blogs,
                'category' => $category,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function AuthorView($slug) {

        try {
            $slug = AdminHelper::Url_Slug($slug);
            $user = User::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404('root');
        }

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Category';

        $userId = $user->id;

        $blogs = Blog::defWeb()->where('user_id', $userId)->orderby('created_at', 'desc')->paginate(12);

        return view('web.user_view')->with(
            [
                'pageView' => $pageView,
                'blogs' => $blogs,
                'user' => $user,
            ]
        );
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # BlogView
    public function BlogView($slug, Contents $contents) {


        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta, 'page_index');
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';

        try {
            $slug = str_replace('.html', '', $slug);

            $slug = AdminHelper::Url_Slug($slug);

            $blog = Blog::defWeb()
                ->whereTranslation('slug', $slug)
                ->with('tags')
                ->with('userName')
                ->with('categories')
                ->with('reviews')
                ->firstOrFail();
        } catch (\Exception $e) {
            self::abortError404();
        }


        $review = self::checkReviews($blog);


        $blogBody = $contents->fromText($blog->des)->getHandledText();
        $blogBody = self::CleanBody($blogBody);
        $contents = $contents->getContentsArray();
        $catid = $blog->categories->first()->id;

        $categories = BlogCategory::query()
            ->withCount('blogs')
            ->orderby('blogs_count', "desc")
            ->having('blogs_count', '>', 0)
            ->take(15)->get();

        $ReletedBlog = Blog::defWeb()
            ->where('id', '!=', $blog->id)
            ->whereHas('categories', function ($query) use ($catid) {
                $query->where('category_id', $catid);
            })->limit(6)->get();

        $popularTags = BlogTags::orderby('count', "desc")->take(10)->get();


        return view('web.blog_view')->with(
            [
                'pageView' => $pageView,
                'blog' => $blog,
                'categories' => $categories,
                'ReletedBlog' => $ReletedBlog,
                'popularTags' => $popularTags,
                'blogBody' => $blogBody,
                'contents' => $contents,
                'review' => $review,
            ]
        );
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CleanBody
    public function CleanBody($blogBody) {
        $find = [
            '<!-- /wp:paragraph -->',
            '<!-- /wp:heading -->',
            '<!-- /wp:list -->',

        ];
        $replace = [
            '<!-- wp:paragraph -->',
            '<!-- wp:heading -->',
            '<!-- wp:list -->',
        ];
        $blogBody = str_replace($find, $replace, $blogBody);

        $pattern = ["/<!-- wp:paragraph -->\r\n/", "/<!-- wp:heading -->\r\n/", "/<!-- wp:list -->\r\n/",];
        $blogBody = preg_replace($pattern, '', $blogBody);
//        $blogBody = preg_replace('/\r\n\r\n/', '<br/>', $blogBody);

        $blogBody = preg_replace('%(\\[caption.*])(.*)(\\[/caption\\])%', '<p class="Blog_Img_Caption">$2</p>', $blogBody);

        return $blogBody;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function checkReviews($blog) {
        if ($blog->updated_at >= $blog->published_at) {
            $hasUpdate = true;
            $to = Carbon::createFromFormat('Y-m-d H:s:i', $blog->updated_at);
            $from = Carbon::createFromFormat('Y-m-d', $blog->published_at);

            $year = $to->diffInYears($from);
            $month = $to->diffInMonths($from);
            $day = $to->diffInDays($from);
            $month = $month > 12 ? $month - (12 * $year) : $month;
            $day = $day > 30 ? $day - ((365 * $year) + ($month * 30)) : $day;
            $cc = '<td>' . $year . ' Year ' . $month . ' Month ' . $day . ' Day ' . '</td>';
        } else {
            $hasUpdate = false;
        }

        if (count($blog->reviews) > 0) {
            $review = [
                'hasReview' => true,
                'userName' => $blog->reviews->first()->userName->name,
                'hasUpdate' => $hasUpdate,

            ];
        } else {
            $review = [
                'hasReview' => false,
                'userName' => null,
                'hasUpdate' => $hasUpdate,
            ];
        }
        return $review;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # TagView
    public function TagView($slug) {
        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta, 'page_index');

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'HomePage';


        $slug = AdminHelper::Url_Slug($slug);
        $tag = BlogTags::whereTranslation('slug', $slug)->firstOrFail();
        $tagId = $tag->id;
        $ReletedBlog = Blog::defWeb()
            ->whereHas('tags', function ($query) use ($tagId) {
                $query->where('tag_id', $tagId);
            })->paginate(12);

        return view('web.tag_view')->with(
            [
                'pageView' => $pageView,
                'tag' => $tag,
                'ReletedBlog' => $ReletedBlog,
            ]
        );
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ContactUs() {
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta, "page_ContactUs");
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Contact';
        return view('web.contact.us')->with(['pageView' => $pageView]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ContactSaveForm
    public function ContactSaveForm(ContactUsFormRequest $request) {
        $saveContactUs = new ContactUsForm();
        $saveContactUs->name = $request->input('name');
        $saveContactUs->phone = $request->input('phone');
        if ($request->input('countryCode_phone') == 'eg') {
            $saveContactUs->full_number = "+2" . $request->input('phone');
        } else {
            $saveContactUs->full_number = "+" . $request->input('countryDialCode_phone') . $request->input('phone');
        }
        $saveContactUs->country = strtoupper($request->input('countryCode_phone'));
        $saveContactUs->subject = $request->input('subject');
        $saveContactUs->message = $request->input('message');
        $saveContactUs->request_type = $request->input('request_type');
        $saveContactUs->listing_id = $request->input('listing_id');
        $saveContactUs->project_id = $request->input('project_id');
        if ($request->input('request_type') == 3) {
            $saveContactUs->meeting_day = Carbon::createFromTimestamp($request->input('meeting_day'))->toDateTimeString();
            $saveContactUs->meeting_time = $request->input('meeting_time');
        }
        $saveContactUs->save();

        Session::forget('RequestListing');
        return redirect()->route('ContactUsThanksPage');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function ContactSaveFormOnPage(ContactUsOnPageRequest $request) {
        $saveContactUs = new ContactUsForm();
        $formId = $request->input('form_id');
        $saveContactUs->name = $request->input('name' . $formId);
        $saveContactUs->phone = $request->input('phone' . $formId);
        if ($request->input('countryCode_' . $formId) == 'eg') {
            $saveContactUs->full_number = "+2" . $request->input('phone' . $formId);
        } else {
            $saveContactUs->full_number = "+" . $request->input('countryDialCode_' . $formId) . $request->input('phone' . $formId);
        }
        $saveContactUs->country = strtoupper($request->input('countryCode_' . $formId));
        $saveContactUs->request_type = $request->input('request_type');
        $saveContactUs->listing_id = $request->input('listing_id');
        $saveContactUs->project_id = $request->input('project_id');
        $saveContactUs->save();
        Session::forget('RequestListing');
        return redirect()->route('ContactUsThanksPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     ContactUsThanksPage
    public function ContactUsThanksPage() {
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta);
        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Contact';
        return view('web.contact.thanks')->with(['pageView' => $pageView]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListing
    public function RequestListing($listid) {
        Session::put('RequestListing', $listid);
        Session::save();
        return redirect()->route('ContactUsRequestPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListing
    public function MeetingRequest($listid) {
        Session::put('RequestListing', $listid);
        Session::save();
        return redirect()->route('MeetingRequestPage');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     RequestListingView
    public function RequestListingView() {

        $pageView = $this->pageView;
        $pageView['SelMenu'] = 'Contact';
        $Meta = parent::getMeatByCatId('contact-us');
        parent::printSeoMeta($Meta);


        $DaysArr = [];
        $thisDay = strtotime('today 00:00:00');
        for ($i = 1; $i <= 10; $i++) {
            if ($i != 1) {
                $thisDay = $thisDay + 86400;
            }
            $Name = Carbon::parse($thisDay)->locale(app()->getLocale())->translatedFormat('jS M Y');
            array_push($DaysArr, ['id' => $thisDay, 'name' => $Name]);

        }
        View::share('DaysArr', $DaysArr);

        if (intval(Session::get('RequestListing')) != 0) {
            $listingId = intval(Session::get('RequestListing'));
            $unit = Listing::def()->where('id', $listingId)->first();
            if ($unit != null) {
                if (Route::currentRouteName() == 'MeetingRequestPage') {
                    $formType = 'meeting';
                } elseif (Route::currentRouteName() == 'ContactUsRequestPage') {
                    $formType = 'request';
                } else {
                    $formType = '';
                }
                return view('web.contact.request')->with(['pageView' => $pageView, 'unit' => $unit, 'formType' => $formType]);
            }
        }
        return view('web.contact.us')->with(['pageView' => $pageView]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   UnderConstruction
    public function UnderConstruction() {
        $config = WebMainController::getWebConfig(0);
        if ($config->web_status == 1 or Auth::check()) {
            return redirect()->route('page_index');
        }
        $Meta = parent::getMeatByCatId('home');
        parent::printSeoMeta($Meta);
        return view('under');
    }


}
