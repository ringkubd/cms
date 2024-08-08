<?php

namespace App\Http\Controllers\AccessControllers;

use App\Admin;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{

  public function create()
  {
    return view("admin.pages.artisan.artisan");
  }

  public function caching($app_key)
  {
    if ($app_key == "all") {
      Artisan::call('route:cache');
      Artisan::call('view:cache');
      Artisan::call('config:cache');
    } else {
      Artisan::call($app_key . ':cache');
    }
    $unique = \App\Admin::unique_user();
    Cache::put($unique . "artisan", ucfirst($app_key) . " Caching Successfully", 3);
    return back();
  }

  public function clear_caching($key)
  {
    if ($key == "all") {
      Artisan::call('route:clear');
      Artisan::call('view:clear');
      Artisan::call('config:clear');
      Artisan::call('cache:clear');
    } else {
      Artisan::call($key . ":clear");
    }
    $unique = \App\Admin::unique_user();
    Cache::put($unique . "artisan", ucfirst($key) . " Cache Clear Successfully", 3);
    return back();
  }


  public function migration_seed($app_key)
  {
    if ($app_key != slug_url(env('APP_KEY'))) {
      abort(403);
    }
    set_time_limit(3600);
    Artisan::call("migrate:refresh --seed");
    $unique = \App\Admin::unique_user();
    Cache::put($unique . "artisan", "Migration with seed Successfully", 3);
    return back();
  }

  public function migrateRefresh($app_key)
  {
    if ($app_key != slug_url(env('APP_KEY'))) {
      abort(403);
    }
    try {
      Artisan::call('migrate:refresh');
      $unique = \App\Admin::unique_user();
      Cache::put($unique . "artisan", "Migartion refresh Successfully", 3);
      return back();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function seed($app_key)
  {
    if ($app_key != slug_url(env('APP_KEY'))) {
      abort(403);
    }
    try {
      set_time_limit(3600);
      Artisan::call('db:seed');
      $unique = \App\Admin::unique_user();
      Cache::put($unique . "artisan", "Database seed Successfully", 3);
      return back();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function down($app_key)
  {
    if ($app_key != slug_url(env('APP_KEY'))) {
      abort(403);
    }
    try {
      Artisan::call('down');
      $unique = \App\Admin::unique_user();
      Cache::put($unique . "artisan", "App is now in Maintenance Mode", 3);
      return back();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function up($app_key)
  {
    if ($app_key != slug_url(env('APP_KEY'))) {
      abort(403);
    }
    try {
      Artisan::call('up');
      $unique = \App\Admin::unique_user();
      Cache::put($unique . "artisan", "App is no more in Maintenance Mode", 3);
      return back();
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}
