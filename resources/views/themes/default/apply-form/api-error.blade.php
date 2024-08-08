@extends('themes/default/layouts/master')

@inject("home", "App\Home")
@inject("api", "App\ApiModel")


@section('title', 'Apply for Vocational Training Programme')
@section("m_title", 'Apply for Vocational Training Programme')
@section("m_url", request()->fullUrl() )
@section("m_image", $home->get_settings("meta_picture"))
@section("m_keywords", $home->get_settings("meta_key"))
@section("m_description", $home->get_settings("meta_desc"))

@section("content")

  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 py-3 offset-md-2">
          <div class="card text-muted" style="min-height: 60vh">
            <div class="card-header text-center">
              <h1>
                Error {{$ststus}}
              </h1>
            </div> <!-- .card-header -->
            <div class="card-body text-center">
              Page not found
            </div>
          </div>
        </div> <!-- .col-md-9 -->
      </div>
    </div> <!-- .container -->
  </section> <!-- .about-content -->
@endsection

