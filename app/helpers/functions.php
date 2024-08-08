<?php

use App\Models\VocationalModels\IntakeModel;

/**
 * @param $string
 * @param string $delimiter
 * @return string
 */
function slug_url($string, $delimiter = "-")
{
  return \Illuminate\Support\Str::slug($string, $delimiter);
}

function bn_slug_url($string, $delimiter = "-")
{
  return str_replace(' ', $delimiter, $string);
}

function unique_user()
{
  if (session()->has('unique')) {
    return session()->get('unique');
  }
  $unique = \App\Admin::unique_user();
  \Illuminate\Support\Facades\Session::put('unique', $unique);
  return $unique;
}

function auth_role_id()
{
  if (\Illuminate\Support\Facades\Auth::check()) {
    return \Illuminate\Support\Facades\Auth::user()->role_id;
  }
  return null;
}


/**
 * @param $img_url
 * @return string
 */
function thumbs_url($img_url)
{
  $img = $img_url;
  $img_thumb = explode('/', $img);
  $directory = dirname($img);
  return $directory . '/' . end($img_thumb);
}


/**
 * @param $url
 * @return bool
 */
function remote_file_exists($url)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_NOBODY, true);
  curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if ($httpCode == 200) {
    return true;
  }
  return false;
}

/**
 * @return array
 */
function set_date_time_format()
{
  return array(
    'M d, Y' => 'Jan 25, 2019',
    'F d, Y' => 'January 25, 2019',
    'd-m-Y' => 'DD-MM-YYYY',
    'm-d-Y' => 'MM-DD-YYYY',
    'Y-m-d' => 'YYYY-MM-DD',
    'Y-d-m' => 'YYYY-DD-MM',
  );
}

/**
 * @return array
 */
function post_template()
{
  return array(
    "Standard",
    "Aside",
    "Gallery",
    "Links",
    "Image",
    "Quota",
    "Status",
    "Audio",
    "Video",
    "Chat",
    "1 column",
    "2 column",
    "3 column",
    "1 column - 2 row",
    "2 row - 1 column",
  );
}

/**
 * @param $text
 * @param int $limit
 * @return string
 */
function word_limiter($text, $limit = 25)
{
  return \Illuminate\Support\Str::words($text, $limit);
}

/**
 * @param $text
 * @param int $limit
 * @return string
 */
function limiter($text, $limit = 55)
{
  return \Illuminate\Support\Str::limit($text, $limit);
}

/**
 * @param $deviceName
 * @return bool
 */
function is_device($deviceName)
{
  $agent = new \Jenssegers\Agent\Agent();
  if ($deviceName == "desktop" && $agent->isDesktop()) {
    return true;
  } elseif ($deviceName == "tablet" && $agent->isTablet()) {
    return true;
  } elseif ($deviceName == "mobile" && $agent->isMobile()) {
    return true;
  } elseif ($deviceName == "phone" && $agent->isPhone()) {
    return true;
  } elseif ($deviceName == "robot" && $agent->isRobot()) {
    return true;
  }
  return false;
}

/**
 * @param $date
 * @param string $format
 * @return string
 */
function web_date_format($date, $format = 'd-m-Y h:i a')
{
  return \Carbon\Carbon::parse($date)->format($format);
}

/**
 * @param $timeString
 * @return string
 */
function web_date($timeString)
{
  $format = \App\Home::get_settings('date_format');
  return \Illuminate\Support\Carbon::parse($timeString)->format($format);
}

/**
 * @param $des
 * @return string
 */
function remove_html_char($des)
{
  $clear = strip_tags($des); // Strip HTML Tags
  $clear = html_entity_decode($clear); // Clean up things like &amp;
  $clear = urldecode($clear); // Strip out any url-encoded stuff
  $clear = preg_replace('/[^A-Za-z0-9]/', ' ', $clear); // Replace non-AlNum characters with space
  $clear = preg_replace('/ +/', ' ', $clear); // Replace Multiple spaces with single space
  return trim($clear); // Trim the string of leading/trailing space
}


function is_trending_now()
{
  $rPath = request()->path();
  $path = \App\Home::get_settings('tranding_now');
  $path = explode(',', $path);
  return in_array($rPath, $path) ? true : false;
}

function trending_now_pages()
{
  return array(
    '/' => 'Home',
    'it-scholarship-programme' => 'IT Scholarship Page',
    'vocational-training-programme' => 'Vocational Training Page',
    'madrasah-education-programme' => 'Madrasah Programme Page',
    'four-year-diploma-scholarship' => '4-Year Diploma Page',
    'orphanage-programme' => 'Orphanage Programme',
    'isdb-bisew-programme' => 'IsDB-BISEW programme Page',
    //trending_now_option
  );
}


if (!function_exists('vocational_widget')) {
  function vocational_apply_widget()
  {
    $intake = IntakeModel::lastIntakeScheduleApi();
    $carbon = new \Carbon\Carbon();
    $now = $carbon->now();
    $end_date = $carbon->create($intake->end_date)->addHour(23)->addMinute(59);
    $isIntake = $now->lessThanOrEqualTo($end_date);

    if ($isIntake) {
      $html = '<h2 class="widget-title"><span>Vocational Training (Round- ' . $intake->round . ')</span></h2>';
    } else {
      $html = '<h2 class="widget-title"><span>Vocational Training </span></h2>';
    }

    $html .= '<div class="card-body">';
    $html .= '<img src="' . asset('themes-assets/default/img/bg-img/voc.jpg') . '" class="img-fluid" alt="Apply for Vocational Training">';
    $html .= '</div>';

    if ($isIntake) {
      $html .= '<ul class="widget-list">';
      $html .= '<li class="item text-center">';
      $html .= '<a class="item-link mb-3" href="/apply">Apply Now</a>';
      $html .= '</li>';
      $html .= '</ul>';
    }

    return $html;
  }
}

if (!function_exists('it_scholarship_widget')) {
  function it_scholarship_widget()
  {

    $html = '<h2 class="widget-title"><span>IT Scholarship</span></h2>';
    $html .= '<div class="card-body" >';
    $html .= '<a href = "http://apply.idb-bisew.info/" title = "Apply for IT Scholarship" target = "_blank"rel = "noreferrer" >';
    $html .= '<img src = "' . asset('themes-assets/default/img/bg-img/r46.gif') . '" class="img-fluid" alt = "Apply IT Scholarship Programme" >';
    $html .= '</a >';
    $html .= '</div >';
    $html .= '<ul class="widget-list">';
    $html .= '<li class="item text-center">';
    $html .= '<a class="item-link mb-3" href="http://apply.idb-bisew.info/">Apply Now</a>';
    $html .= '</li>';
    $html .= '</ul>';
    return $html;
  }
}
