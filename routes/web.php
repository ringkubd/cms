<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'FrontController@index');
//Auth::logout();

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', 'HomeController@index');
  Route::get("api-testing", "HomeController@api_testing");

  Route::namespace('AccessControllers')->group(function () {
    Route::post('find-admin-menu', 'SetupAccessController@find_menu_by_ajax');
    Route::post('find-alignment-menu', 'SetupAccessController@find_alignment_ajax');
    Route::post('add-to-front-menu', 'FrontMenuController@add_to_front_menu');
    Route::post('get-active-menus', 'FrontMenuController@get_active_front_menu');
    Route::post('get-admin-menu', 'AdminMenuController@get_admin_menu');
  });

  Route::namespace('ContentControllers')->group(function () {
    Route::post('get-case-study-info', 'PostController@get_case_study_info'); // ajax get student info
    Route::post('get-slug-from-title', 'PostController@get_slug_menu'); // ajax get slug url
  });
});


Route::middleware(['auth', 'verified', 'permission'])->group(function () {
  Route::prefix('admin')->group(function () {
    Route::get('api-token', 'VtApiController@api_token_form');
    Route::post('api-token', 'VtApiController@api_token_save');
    Route::resource('contact', 'SupportController\ContactController')->except(['create', 'store']);
    Route::resource('certificate-award', 'CertificateAwardController')->except(['store', 'edit', 'update', 'destroy']);
  });
  Route::namespace('AccessControllers')->group(function () {
    Route::prefix('admin')->group(function () {
      Route::resource('admin-menu', 'AdminMenuController');
      Route::post('save-resource-menu', 'AdminMenuController@resourceStore');
      Route::get('admin-menu/{admin_menu}/clone', 'AdminMenuController@clone');
      Route::resource('role', 'RoleController');
      Route::resource('user', 'UserController');
      Route::resource('setup-access', 'SetupAccessController');
      Route::post('save-alignment', 'SetupAccessController@save_alignment');
      Route::resource("menu", 'FrontMenuController');
      Route::resource('group-menu', 'MenuGroupController');
    }); // end prefix admin

    Route::prefix('admin/artisan')->group(function () {
      Route::get('/', 'ArtisanController@create');
      Route::get('cache/{key}', 'ArtisanController@caching');
      Route::get('clear-cache/{key}', 'ArtisanController@clear_caching');
      Route::get('migrate-seed/{app_key}', 'ArtisanController@migration_seed');
      Route::get('migrateRefresh/{app_key}', 'ArtisanController@migrateRefresh');
      Route::get('db-seed/{app_key}', 'ArtisanController@seed');
      Route::get('down/{app_key}', 'ArtisanController@down');
      Route::get('up/{app_key}', 'ArtisanController@up');
    }); // end prefix admin/artisan

  }); // end AccessControllers namespace

  Route::namespace('ContentControllers')->group(function () {
    Route::prefix('admin')->group(function () {
      Route::resource('module', 'ModuleController');
      Route::get('settings/general-settings', 'SettingsController@index');
      Route::post('settings/general-settings-save', 'SettingsController@general_settings_save');
      Route::get('settings/theme', 'SettingsController@theme_settings');
      Route::post('settings/save-page-path', 'SettingsController@save_page_path');
      Route::post('settings/theme-settings-save', 'SettingsController@theme_settings_save');
      Route::resource('page', 'PageController');

      Route::resource('vtp-auto-notice', 'VtpAutoNoticeController'); //vocation training auto notice
      Route::get('vtp-auto-notice-refresh', 'VtpAutoNoticeController@vtp_auto_notice_refresh');

      Route::resource('term', 'TermTaxonomyController');
      Route::get("manage-image", "FileManager@index");
      Route::get("manage-file", "FileManager@create");
      Route::resource('photo-gallery', 'GalleryController');
      Route::post('image/upload/store', 'GalleryController@fileStore');
      Route::post('image/delete', 'GalleryController@fileDestroy');
      Route::post('image-save', 'GalleryController@store');
      Route::delete('image-delete/{id}', 'GalleryController@destroy');
      Route::put('image-update/{id}', 'GalleryController@update');
      Route::resource('advertisement', 'AdvertisementController');
      Route::get("filter-post-data", "PostController@filter_post_data");
      Route::get("filter-advertisement", "AdvertisementController@filter_advertisement");
      Route::resource('widget-group', 'WidgetGroupController')->except(['show']); // manage widget group
      Route::resource('note', 'NotesController'); // add to widget
      Route::put('note/{note}/quick-edit', 'NotesController@quick_edit'); // add to widget

      Route::resource('widget', 'WidgetController')->except(['show']); // manage widget
      Route::post('widget-set', 'WidgetController@widget_set'); // add to widget
      Route::post('widget-get', 'WidgetController@widget_get'); // add to widget
      Route::post('widget/remove', 'WidgetController@widget_remove'); // add to widget

    }); // end prefix admin

    Route::prefix('admin/term')->group(function () {
      Route::resource('taxonomy', 'TaxonomyController');
      Route::get('category/create', 'TaxonomyController@create');
      Route::get('category/{category}/edit', 'TaxonomyController@edit');
      Route::get('tags/create', 'TaxonomyController@create');
      Route::get('tags/{tags}/edit', 'TaxonomyController@edit');
      Route::get('photo-gallery/photo-category/create', 'TaxonomyController@create');
      Route::get('photo-gallery/photo-category/{photo_category}/edit', 'TaxonomyController@edit');
      //==newTaxonomuRoute==
    }); // end prefix admin/term

    Route::prefix('admin/type')->group(function () {
      // Route::resource('post', 'PostController');
      Route::resource('photo-gallery', 'GalleryController');
      Route::resource('it-scholarship-programme', 'PostController');
      Route::resource('vocational-training-programme', 'PostController');
      Route::resource('madrasah-education-programme', 'PostController');
      Route::resource('four-year-diploma-scholarship', 'PostController');
      Route::resource('orphanage-programme', 'PostController');
      Route::resource('other-programme', 'PostController');
      Route::resource('idb-bhaban', 'PostController');
      Route::resource('tender-notice', 'PostController');
      Route::resource('tender', 'PostController');
      Route::resource('isdb-bisew', 'PostController');
    }); // end prefix admin/type

  }); // end ContentControllers namespace

  Route::prefix('admin')->namespace('InfoControllers')->group(function () {
    Route::resource('round', 'RoundController');
    Route::resource('company', 'CompanyController');
    Route::resource('position', 'PositionController');
    Route::resource('course', 'CourseController');
    Route::resource('student', 'StudentController');
  }); // end ContentControllers namespace

});


Auth::routes(['verify' => true, 'register' => true]);

Route::get("video", "FrontController@streaming_video");

Route::get('forms', "FrontController@download_forms");
Route::get("about", "FrontController@about_us");
Route::get('download', 'FrontController@download');
Route::get('contact', "SupportController\ContactController@create");
Route::post('contact', "SupportController\ContactController@store");

Route::get("isdb-bisew-programme", "FrontController@isdb_bisew_programme");
Route::get("notice", "FrontController@latest_notice");
Route::get("tender_notice", "FrontController@tender_notice");
Route::get("top-job-placement", "FrontController@top_job_placement");
Route::get("top-freelancer", "FrontController@top_freelancer");
Route::get("latest-updates", "FrontController@latest_updates");

Route::get("tenders", "FrontController@tender");


Route::get("anwar", "FrontController@tender");
Route::get("tender", "FrontController@tender");


Route::get("photo-gallery", "FrontController@photo_gallery");
Route::get("filter", "FrontController@filter_post");


Route::namespace('VocationalControllers')->group(function () {
  // apply controller
  Route::get('apply', 'ApplyController@apply');
  Route::get('vocational-training-programme/apply', 'ApplyController@index');
  Route::get('vocational-training-programme/apply/show', 'ApplyController@show');

  Route::post('vocational-training-programme/apply', 'ApplyController@store');
  Route::get('vocational-training-programme/admit-card', 'ApplyController@create');
  Route::post('vocational-training-programme/admit-card', 'ApplyController@admin_card_show');
  Route::post('vocational-training-programme/download', 'ApplyController@download_admin_card');
});


Route::get('vtp-auto-notice-refresh', 'ContentControllers\VtpAutoNoticeController@vtp_auto_notice_refresh');


Route::get('{module}/{slug}', 'FrontController@module_page');
Route::get("{module}/{id}/{slug}", "FrontController@module_post");
Route::get("{module}/notice/{id}/{slug}", "FrontController@module_post");
Route::get("{module}/{category}/{id}/{slug}", "FrontController@module_category_post");

Route::get("{page}", "FrontController@single_page");
