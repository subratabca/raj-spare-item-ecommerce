<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Middleware\AdminTokenVerificationMiddleware;
use App\Http\Middleware\ClientTokenVerificationMiddleware;

// Admin
use App\Http\Controllers\Backend\Auth\AdminAuthController;
use App\Http\Controllers\Backend\AdminProfileController; 
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\AdminProductController;
use App\Http\Controllers\Backend\AdminOrderController;
use App\Http\Controllers\Backend\ClientListController;
use App\Http\Controllers\Backend\CustomerListController;
use App\Http\Controllers\Backend\AdminComplainController;
use App\Http\Controllers\Backend\AdminCustomerComplainController;
use App\Http\Controllers\Backend\AdminNotificationController;
use App\Http\Controllers\Backend\AdminReportController;
use App\Http\Controllers\Backend\AdminContactMessageController;

use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\TermsConditionsController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\HeroController;
use App\Http\Controllers\Backend\AdminAuditController;
use App\Http\Controllers\Backend\AdminChartReportController;

// Client
use App\Http\Controllers\Client\Auth\ClientAuthController;
use App\Http\Controllers\Client\ClientProfileController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\ClientBrandController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\ClientNotificationController;
use App\Http\Controllers\Client\ClientReportController;
use App\Http\Controllers\Client\ClientComplainController;
use App\Http\Controllers\Client\ClientCustomerComplainController;
use App\Http\Controllers\Client\ClientBannedController;
use App\Http\Controllers\Client\ClientFollowerController;
use App\Http\Controllers\Client\ClientTermsConditionsController;
use App\Http\Controllers\Client\ClientCustomerListController;

// Frontend
use App\Http\Controllers\Frontend\SocialAuthController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\WishListController;
use App\Http\Controllers\Frontend\FollowerController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\ComplainController;
use App\Http\Controllers\Frontend\CustomerComplainController;
use App\Http\Controllers\Frontend\JWTTokenController;
use App\Http\Controllers\Frontend\FacebookShareController;
use App\Http\Controllers\Frontend\EmailShareController;
use App\Http\Controllers\Frontend\TwitterController;
use App\Http\Controllers\Frontend\SocialShareController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CartPageController;

Route::controller(SocialShareController::class)->group(function () {
    Route::get('/social-share', 'index');
});

Route::controller(JWTTokenController::class)->group(function () {
    Route::post('/verify-token', 'verifyToken');
});

Route::controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/{provider}','redirectToProvider')->name('auth.socialite.redirect');
    Route::get('/auth/{provider}/callback', 'handleProviderCallback')->name('auth.socialite.callback');
});

Route::controller(TwitterController::class)->group(function(){
    Route::get('auth/twitter', 'redirectToTwitter')->name('auth.twitter');
    Route::get('auth/twitter/callback', 'handleTwitterCallback');
});

// Frontend API Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/','HomePage')->name('home');
    Route::get('/setting-list', 'SettingList');
    Route::get('/hero-page-info','HeroPageInfo');
    Route::get('/product-list', 'productList');
    Route::get('/search-product','searchProduct');
});

Route::controller(PagesController::class)->group(function () {
    Route::get('/about-us','aboutPage')->name('about');
    Route::get('/about-page-info','aboutPageInfo');

    Route::get('/product-details/{id}','productDetailsPage')->name('product.by.id');
    Route::get('/product-details-info/{id}','productDetailsInfo');

    Route::get('/contact-us','contactPage')->name('contact.us.page');
    Route::post('/store-contact-info','storeContactInfo');

    Route::post('/store-newsletter-subscription-info','storNnewsletterSubscriptionInfo');
    
    Route::get('/clients','getClients');
    Route::get('/categories','getCategories');
    Route::get('/brands','getBrands');
    Route::get('/countries','getCountries')->name('country');
    Route::get('/counties/{countryId}','getCountiesByCountry')->name('county');;
    Route::get('/cities/{countyId}','getCiiesByCounty')->name('city');
});

Route::prefix('user')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/registration/terms-conditions/{name}','TermsConditionsPage');
        Route::get('/registration/terms-conditions/info/{name}','TermsConditionsInfo');
        
        Route::get('/registration','RegistrationPage')->name('register.page');
        Route::post('/registration','Registration');

        Route::get('/verify','VerifyCustomer')->name('verify.new.customer');
        Route::get('/login','LoginPage')->name('login.page');
        Route::post('/login','Login');

        Route::get('/sendOtp','SendOtpPage');
        Route::post('/send-otp','SendOTPCode');

        Route::get('/verifyOtp','VerifyOTPPage');
        Route::post('/verify-otp','VerifyOTP');

        Route::get('/resetPassword','ResetPasswordPage');
        Route::post('/reset-password','ResetPassword');
    });
});

Route::prefix('user')->middleware([TokenVerificationMiddleware::class])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile','ProfilePage')->name('user.profile');
        Route::get('/profile/info','Profile');
        Route::post('/profile/update','UpdateProfile');
        Route::get('/update/password','PasswordPage')->name('user.update.password');
        Route::post('/password/update','UpdatePassword');

        Route::get('/document','DocumentPage')->name('user.update.document');
        Route::post('/store/document/info','StoreDocumentInfo');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard','DashboardPage')->name('user.dashboard');
        Route::get('/total/information', 'TotalInfo');
        Route::get('/logout','Logout')->name('logout');
    });

    Route::controller(CartController::class)->group(function () {
        Route::get('/my-cart',  'myCart')->name('mycart');
        Route::get('/get-cart-product', 'getCartProduct')->name('cart.index');
        Route::post('/cart/add', 'add')->name('cart.add');
        Route::post('/cart/update', 'update')->name('cart.update');
        Route::post('/cart/remove', 'remove')->name('cart.remove');
        Route::get('/cart/count', 'count')->name('cart.count');
        Route::get('/cart/total', 'total')->name('cart.total');

        Route::get('/validate-coupon/{code}', 'validateCoupon');
        Route::post('/cart/apply-coupon', 'applyCoupon');
        Route::post('/cart/remove-coupon', 'removeCoupon');
    });

    Route::controller(FacebookShareController::class)->group(function () {
        Route::post('/facebook/share/{foodId}','shareToFacebook')->name('facebook.share');
        Route::post('/facebook/url/share/{foodId}','shareFacebookURL');
    });

    Route::controller(EmailShareController::class)->group(function () {
        Route::post('/share-item-with-email','shareToEmail')->name('email.share');
        Route::get('/email/share/list', 'EmailShareListPage')->name('user.email.share.list');
        Route::get('/email/share/list/info','EmailShareList');
        Route::post('/email/share/delete','delete');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::post('/store/product-request', 'store');
        Route::get('/order-list', 'OrderPage')->name('orders');
        Route::get('/orders','OrderList');
        Route::get('/order-details/{order_id}','OrderDetailsPage');
        Route::get('/order-details-info/{order_id}','OrderDetailsInfo');
    });

    Route::controller(WishListController::class)->group(function () {
        Route::post('/store/wishlist-request', 'StoreWishListRequest');
        Route::get('/wishlist', 'WishListPage')->name('wishlists');
        Route::get('/wishlist-info','WishList');
        Route::post('/delete/wishlist','delete');
        Route::get('/wishlist/count', 'count');
    });

    Route::controller(FollowerController::class)->group(function () {
        Route::post('/store/follower-request', 'StoreFollowerListRequest');
        Route::get('/followed/list', 'FollowedListPage')->name('followers');
        Route::get('/followed-clients','FollowedClientsList');
    });

    Route::controller(ComplainController::class)->group(function () {
        Route::get('/food/complain/{order_id}','FoodComplainPage');
        Route::post('/store-complain-info','StoreComplainInfo');

        Route::post('/upload-editor-image','uploadEditorImage');
        Route::post('/delete-editor-image','deleteEditorImage');

        Route::get('/complain-list', 'ComplainPage')->name('complains');
        Route::get('/complains','ComplainList');

        Route::get('/complain/reply/{complain_id}','FoodComplainReplyPage');
        Route::post('/store-complain-reply-info','StoreComplainReplyInfo');

        Route::get('/complain-details/{id}','ComplainDetailsPage');
        Route::get('/complain-details-info/{id}','ComplainDetailsInfo');
    });

    Route::controller(CustomerComplainController::class)->group(function () {
        Route::get('/customer-complain-list', 'CustomerComplainPage')->name('customer.complains');
        Route::get('/customer-complains','CustomerComplainList');

        Route::get('/customer-complain-details/{complain_id}','CustomerComplainDetailsPage');
        Route::get('/customer-complain-details-info/{complain_id}','CustomerComplainDetailsInfo');

        Route::post('/upload-customer-complain-editor-image','uploadEditorImage');
        Route::post('/delete-customer-complain-editor-image','deleteEditorImage');

        Route::get('/customer-complain/appeal/{complain_id}','CustomerComplainAppealPage');
        Route::post('/store-customer-complain-appeal-info','StoreCustomerComplainAppealInfo');
    });

    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification-list', 'NotificationPage')->name('notifications');
        Route::get('/limited/notification/list', 'LimitedNotificationList');
        Route::get('/notification/list/info', 'NotificationList');
        Route::get('/markAsRead', 'MarkAsRead')->name('markRead');
        Route::delete('/delete/notification/{notificationId}', 'deleteNotification');
    });
});
    
// Admin API Routes
Route::prefix('admin')->group(function () {
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/registration','RegistrationPage')->name('admin.registration.page');
        Route::post('/registration','Registration');

        Route::get('/login','LoginPage')->name('admin.login.page');
        Route::post('/login','Login');

        Route::get('/sendOtp','SendOtpPage');
        Route::post('/send-otp','SendOTPCode');

        Route::get('/verifyOtp','VerifyOTPPage');
        Route::post('/verify-otp','VerifyOTP');

        Route::get('/resetPassword','ResetPasswordPage');
        Route::post('/reset-password','ResetPassword');
    });
});

Route::prefix('admin')->middleware([AdminTokenVerificationMiddleware::class])->group(function () {
    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('/dashboard','DashboardPage')->name('admin.dashboard');
        Route::get('/total/information', 'TotalInfo');
        Route::get('/logout','Logout')->name('admin.logout');
    });

    Route::controller(AdminAuditController::class)->group(function () {
        Route::get('/audit/list', 'AuditLogPage')->name('audits');
        Route::get('/audit/list/info','index');
        Route::get('/audit/details/{id}','DetailsPage');
        Route::get('/audit/info/{id}','show');
        Route::post('/delete/audit','delete');
    });

    Route::controller(AdminProfileController::class)->group(function () {
        Route::get('/update/profile','ProfilePage');
        Route::get('/profile/info','Profile');
        Route::post('/profile/update','UpdateProfile');
        Route::get('/update/password','PasswordPage');
        Route::post('/password/update','UpdatePassword');

        Route::get('/download/doc-image1/{client_id}', 'downloadDocImage1')->name('client.download.doc1');
        Route::get('/download/doc-image2/{client_id}', 'downloadDocImage2')->name('client.download.doc2');
    });

    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/product-list', 'ProductPage')->name('products');
        Route::get('/index','index');
        Route::get('/create/product','CreatePage');
        Route::post('/store/product','store');
        Route::get('/product/details/{id}','DetailsPage');
        Route::get('/product/info/{id}','show');
        Route::get('/edit/product/{id}','EditPage');
        Route::post('/update/product','update');
        Route::post('/product/delete','delete');
        Route::post('/update/product/status','ProductPublish');

        Route::get('/edit/product/multi-image/{id}','EditMultiImgPage');
        Route::post('/update-multi-image','updateMultiImg');
    });

    Route::controller(AdminOrderController::class)->group(function () {
        Route::get('/order/list', 'OrderPage')->name('admin.orders');
        Route::get('/orders','OrderList');
        Route::get('/order/details/{order_id}','OrderDetailsPage');
        Route::get('/order/details/info/{order_id}','OrderDetails');
        Route::post('/order/delete','delete');
    });

    Route::controller(AdminComplainController::class)->group(function () {
        Route::get('/complain-list', 'ComplainPage')->name('admin.complains');
        Route::get('/complains','ComplainList');
        Route::get('/complain/details/{complain_id}','ComplainDetailsPage');
        Route::get('/complain/details/info/{complain_id}','ComplainDetails');
        Route::get('/complain-send/{id}','ComplainSendToClient');

        Route::post('/upload-editor-image','uploadEditorImage');
        Route::post('/delete-editor-image','deleteEditorImage');

        Route::post('/complain-solved','ComplainSolved');
        Route::post('/complain-investigation','ComplainInvestigation');

        Route::post('/complain/delete','delete');
    });

    Route::controller(ClientListController::class)->group(function () {
        Route::post('/update/client/account/{client_id}', 'UpdateClientAccount');

        Route::get('/client-list', 'ClientPage')->name('clients');
        Route::get('/clients','ClientList');

        Route::get('/client/details/{client_id}','ClientDetailsPage');
        Route::get('/client/details/info/{client_id}','ClientDetailsInfo');

        Route::get('/order/list/by/client/{client_id}','OrderListPageByClient');
        Route::get('/order/list/by/client/info/{client_id}','OrderListByClient');

        Route::get('/complain/list/by/client/{client_id}','ComplainListPageByClient');
        Route::get('/complain/list/by/client/info/{client_id}','ComplainListByClient');

        Route::get('/customer/list/by/client/{client_id}','CustomerListPageByClient');
        Route::get('/customer/list/by/client/info/{client_id}','CustomerListByClient');

        Route::get('/food/list/by/client/{client_id}','FoodListPageByClient');
        Route::get('/food/list/by/client/info/{client_id}','FoodListByClient');

        Route::post('/client/delete','delete');
    });

    Route::controller(CustomerListController::class)->group(function () {
        Route::post('/update/customer/account/{customer_id}', 'UpdateCustomerAccount');
        
        Route::get('/customer-list', 'CustomerPage')->name('customers');
        Route::get('/customers','CustomerList');

        Route::get('/customer/details/{customer_id}','CustomerDetailsPage');
        Route::get('/customer/details/info/{customer_id}','CustomerDetailsInfo');

        Route::get('/order/list/by/customer/{customer_id}','OrderListPageByCustomer');
        Route::get('/order/list/by/customer/info/{customer_id}','OrderListByCustomer');

        Route::get('/complain/list/by/customer/{customer_id}','ComplainListPageByCustomer');
        Route::get('/complain/list/by/customer/info/{customer_id}','ComplainListByCustomer');

        Route::get('/client/list/by/customer/{customer_id}','ClientListPageByCustomer');
        Route::get('/client/list/by/customer/info/{customer_id}','ClientListByCustomer');

        Route::get('/customer-complain/list/by/customer/{customer_id}','CustomerComplainListPageByCustomer');
        Route::get('/customer-complain/list/by/customer/info/{customer_id}','CustomerComplainListInfoByCustomer');

        Route::post('/customer/delete','delete');
    });

    Route::controller(AdminCustomerComplainController::class)->group(function () {
        Route::get('/customer-complain-list', 'CustomerComplainPage')->name('admin.customer-complains');
        Route::get('/customer-complain-info','CustomerComplainList');
        Route::get('/customer-complain/details/{complain_id}','CustomerComplainDetailsPage');
        Route::get('/customer-complain/details/info/{complain_id}','CustomerComplainDetailsInfo');
        Route::post('/customer-complain/delete','delete');
        
        Route::get('/customer-complain-send/{complain_id}','ComplainSendToCustomer');
        Route::post('/upload-editor-customer-complain-image','uploadEditorImage');
        Route::post('/delete-editor-customer-complain-image','deleteEditorImage');
        Route::post('/customer-complain-solved','CustomerComplainSolved');
    });

    Route::controller(AdminContactMessageController::class)->group(function () {
        Route::get('/contact-message/list', 'ContactPage')->name('admin.contact.message');
        Route::get('/contact-message/list/info','index');
        Route::get('/contact-message/details/{id}','DetailsPage');
        Route::get('/contact-message/info/{id}','show');
        Route::post('/delete/contact-message','delete');
    });

    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/setting-page', 'SettingPage')->name('site.settings');
        Route::get('/site-setting-list','index');
        Route::get('/create/site-setting','create');
        Route::post('/store/site-setting','store');
        Route::get('/site-setting/info/{id}','show');
        Route::get('/edit/site-setting/{id}','EditPage');
        Route::post('/update/site-setting','update');
        Route::post('/delete/site-setting','delete');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/page', 'CategoryPage')->name('categories');
        Route::get('/category/list','index');
        Route::get('/create/category','create');
        Route::post('/store/category','store');
        Route::get('/show/category/info/{id}','show');
        Route::get('/edit/category/{id}','EditPage');
        Route::post('/update/category','update');
        Route::post('/delete/category','delete');
    });

    Route::controller(TermsConditionsController::class)->group(function () {
        Route::get('/terms-conditions/list', 'TermsConditionsPage')->name('terms.conditions');
        Route::get('/terms-conditions/list/info','index');
        Route::get('/create/terms-conditions','CreatePage');
        Route::post('/store/terms-conditions','store');
        Route::get('/terms-conditions/details/{id}','DetailsPage');
        Route::get('/terms-conditions/info/{id}','show');
        Route::get('/edit/terms-conditions/{id}','EditPage');
        Route::post('/update/terms-conditions','update');
        Route::post('/delete/terms-conditions','delete');
        Route::get('/terms-conditions/{name}','TermsConditionsPageByType');
        Route::get('/terms-conditions-info/by/{name}','TermsConditionsInfoByType');
    });

    Route::controller(AboutController::class)->group(function () {
        Route::get('/about/page', 'AboutPage')->name('abouts');
        Route::get('/about/list','index');
        Route::get('/create/about','create');
        Route::post('/store/about','store');
        Route::get('/show/about/info/{id}','show');
        Route::get('/edit/about/{id}','EditPage');
        Route::post('/update/about','update');
        Route::post('/delete/about','delete');
    });

    Route::controller(HeroController::class)->group(function () {
        Route::get('/hero/page', 'HeroPage')->name('heros');
        Route::get('/hero/list','index');
        Route::get('/create/hero','create');
        Route::post('/store/hero','store');
        Route::get('/show/hero/info/{id}','show');
        Route::get('/edit/hero/{id}','EditPage');
        Route::post('/update/hero','update');
        Route::post('/delete/hero','delete');
    });

    Route::controller(AdminNotificationController::class)->group(function () {
        Route::get('/notification/list', 'NotificationPage')->name('admin.notifications');
        Route::get('/limited/notification/list', 'LimitedNotificationList');
        Route::get('/notification/list/info', 'NotificationList');
        Route::get('/markAsRead', 'MarkAsRead')->name('admin.markRead');
        Route::delete('/delete/notification/{notificationId}', 'deleteNotification');
    });

    Route::controller(AdminReportController::class)->group(function () {
        Route::get('/todays/order/reports', 'TodaysReportPage')->name('todays.report');
        Route::get('/todays/order/information', 'TodaysOrderInfo');

        Route::get('search/reports', 'ReportSearchPage')->name('search.report');
        Route::post('order/by/search', 'OrderBySearch');
    });

    Route::controller(AdminChartReportController::class)->group(function () {
        Route::get('/bar/chart/order', 'ChartOrderPage')->name('bar.chart.order');
        Route::get('/bar/chart/order/information', 'getOrderChartData');
    });
});



// Client API Routes
Route::prefix('client')->group(function () {
    Route::controller(ClientAuthController::class)->group(function () {
        Route::get('/registration/terms-conditions/{name}','TermsConditionsPage');
        Route::get('/registration/terms-conditions/info/{name}','TermsConditionsInfo');

        Route::get('/registration','RegistrationPage')->name('client.registration.page');
        Route::post('/registration','Registration');

        Route::get('/verify','VerifyClient')->name('verify.new.client');
        Route::get('/login','LoginPage')->name('client.login.page');
        Route::post('/login','Login');

        Route::get('/sendOtp','SendOtpPage');
        Route::post('/send-otp','SendOTPCode');

        Route::get('/verifyOtp','VerifyOTPPage');
        Route::post('/verify-otp','VerifyOTP');

        Route::get('/resetPassword','ResetPasswordPage');
        Route::post('/reset-password','ResetPassword');
    });
});

Route::prefix('client')->middleware([ClientTokenVerificationMiddleware::class])->group(function () {
    Route::controller(ClientDashboardController::class)->group(function () {
        Route::get('/dashboard','DashboardPage')->name('client.dashboard');
        Route::get('/total/information', 'TotalInfo');
        Route::get('/logout','Logout')->name('client.logout');
    });

    Route::controller(ClientProfileController::class)->group(function () {
        Route::get('/update/profile','ProfilePage');
        Route::get('/profile/info','Profile');
        Route::post('/profile/update','UpdateProfile');
        Route::get('/update/password','PasswordPage');
        Route::post('/password/update','UpdatePassword');
        Route::get('/account/details/{client_id}','ClientDetailsPage');
        Route::get('/account/details/info/{client_id}','ClientDetailsInfo');

        Route::get('/document','DocumentPage')->name('client.update.document');
        Route::post('/store/document/info','StoreDocumentInfo');
    });

    Route::controller(ClientBrandController::class)->group(function () {
        Route::get('/brand/page', 'BrandPage')->name('client.brands');
        Route::get('/brand/list','index');
        Route::get('/create/brand','create');
        Route::post('/store/brand','store');
        Route::get('/show/brand/info/{id}','show');
        Route::get('/edit/brand/{id}','EditPage');
        Route::post('/update/brand','update');
        Route::post('/delete/brand','delete');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::get('/coupon/page', 'couponPage')->name('client.coupons');
        Route::get('/coupon/list','index');
        Route::get('/create/coupon','create');
        Route::post('/store/coupon','store');
        Route::get('/show/coupon/info/{id}','show');
        Route::get('/edit/coupon/{id}','edit');
        Route::post('/update/coupon','update');
        Route::post('/delete/coupon','delete');
    });

    Route::controller(ClientProductController::class)->group(function () {
        Route::get('/product-list', 'ProductPage')->name('client.products');
        Route::get('/index','index');
        Route::get('/create/product','CreatePage');
        Route::post('/store/product','store');

        Route::get('/product/details/{id}','DetailsPage');
        Route::get('/product/info/{id}','show');

        Route::get('/edit/product/{id}','EditPage');
        Route::post('/update/product','update');
        Route::post('/product/delete','delete');

        Route::get('/edit/product/multi-image/{id}','EditMultiImgPage');
        Route::post('/update-multi-image','updateMultiImg');

        Route::post('/product/variant/delete','deleteVariant');
    });

    Route::controller(ClientOrderController::class)->group(function () {
        Route::get('/order/list', 'OrderPage')->name('client.orders');
        Route::get('/orders','OrderList');

        Route::get('/order/details/{order_id}','OrderDetailsPage');
        Route::get('/order/details/info/{order_id}','OrderDetails');

        Route::post('/approve/food/request','ApproveFoodRequest');
        Route::post('/delivered/food/request','DeliveredFoodRequest');
        Route::post('/cancel/food/request','CancelFoodRequest');
    });


    Route::controller(ClientComplainController::class)->group(function () {
        Route::get('/complain-list', 'ComplainPage')->name('client.complains');
        Route::get('/complains','ComplainList');

        Route::get('/complain/details/{complain_id}', 'ComplainDetailsPage');
        Route::get('/complain/details/info/{complain_id}','ComplainDetails');

        Route::post('/upload-editor-image','uploadEditorImage');
        Route::post('/delete-editor-image','deleteEditorImage');

        Route::post('/store-complain-feedback','StoreComplainFeedbackInfo');
        Route::post('/complain/delete','delete');
    });

    Route::controller(ClientCustomerListController::class)->group(function () {
        Route::get('/customer-list', 'CustomerPage')->name('client.customers');
        Route::get('/customers','CustomerList');

        Route::get('/customer/details/{customer_id}','CustomerDetailsPage');
        Route::get('/customer/details/info/{customer_id}','CustomerDetailsInfo');

        Route::get('/order/list/by/customer/{customer_id}','OrderListPageByCustomer');
        Route::get('/order/list/by/customer/info/{customer_id}','OrderListByCustomer');

        Route::get('/complain/list/by/customer/{customer_id}','ComplainListPageByCustomer');
        Route::get('/complain/list/by/customer/info/{customer_id}','ComplainListByCustomer');

        Route::get('/customer-complain/list/by/customer/{customer_id}','CustomerComplainListPageByCustomer');
        Route::get('/customer-complain/list/by/customer/info/{customer_id}','CustomerComplainListInfoByCustomer');
    });

    Route::controller(ClientCustomerComplainController::class)->group(function () {
        Route::post('/upload-complain-editor-image','uploadEditorImage');
        Route::post('/delete-complain-editor-image','deleteEditorImage');
        Route::post('/store-customer-complain','StoreCustomerComplain');

        Route::get('/customer-complain-list', 'CustomerComplainPage')->name('client.customer-complains');
        Route::get('/customer-complain-info','CustomerComplainList');

        Route::get('/customer-complain/details/{complain_id}','CustomerComplainDetailsPage');
        Route::get('/customer-complain/details/info/{complain_id}','CustomerComplainDetailsInfo');
        
        Route::post('/customer-complain/delete','delete');
    });

    Route::controller(ClientBannedController::class)->group(function () {
        Route::post('/upload-banned-editor-image','uploadEditorImage');
        Route::post('/delete-banned-editor-image','deleteEditorImage');
        Route::post('/store-banned-customer-info','StoreBannedCustomerInfo');

        Route::get('/ban-customer-list', 'BanCustomerPage')->name('client.ban-customers');
        Route::get('/ban-customer-info','BanCustomerList');
        Route::post('/ban-customer/delete','delete');
    });

    Route::controller(ClientFollowerController::class)->group(function () {
        Route::get('/follower/list', 'FollowersListPage')->name('client.followers');
        Route::get('/followers-info','FollowersList');
        Route::post('/delete/follower','delete');
    });

    Route::controller(ClientNotificationController::class)->group(function () {
        Route::get('/notification/list', 'NotificationPage')->name('client.notifications');
        Route::get('/limited/notification/list', 'LimitedNotificationList');
        Route::get('/notification/list/info', 'NotificationList');
        Route::get('/markAsRead', 'MarkAsRead')->name('client.markRead');
        Route::delete('/delete/notification/{notificationId}', 'deleteNotification');
    });

    Route::controller(ClientReportController::class)->group(function () {
        Route::get('/todays/order/reports', 'TodaysReportPage')->name('client.todays.report');
        Route::get('/todays/order/information', 'TodaysOrderInfo');

        Route::get('/search/reports', 'ReportSearchPage')->name('client.search.report');
        Route::post('/order/by/search', 'OrderBySearch');
    });

    Route::controller(ClientTermsConditionsController::class)->group(function () {
        Route::get('/terms-conditions/{name}','TermsConditionsPage');
        Route::get('/terms-conditions/info/{name}','TermsConditionsInfo');
    });
});


