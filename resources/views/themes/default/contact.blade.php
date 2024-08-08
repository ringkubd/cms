@extends('themes/default/layouts/master')

@inject("home", "App\Home")

@section('title', 'Contact with IsDB-BISEW')
@section('m_title', limiter($home->get_settings('meta_title'), 90))
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
<section class="contact-section">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-8 py-3">
        @if(session('success'))
        <div class="alert alert-success custom-alert alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          {{session('success')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger custom-alert alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Alert!</h4>
          @foreach ($errors->all() as $error)
          <p class="m-0">{{ $error }}</p>
          @endforeach
        </div>
        @endif
        <h1 class="area-title">
          <span class="title-text">Contact Info</span>
        </h1>
        <div class="row">
          <div class="col-sm-3">
            <div class="post-content">
              {!! $contact->post_content !!}
            </div>
          </div> <!-- .col-sm-4 -->
          <div class="col-sm-9">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1825.570595792179!2d90.37827496333759!3d23.77798603401108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c74c29ceeafb%3A0xe72ef11d9cf0aeef!2sIslamic%20Development%20Bank-Bangladesh%20Islamic%20Solidarity%20and%20Educational%20Wakf%20(IDB-BISEW)!5e0!3m2!1sen!2sbd!4v1572334670782!5m2!1sen!2sbd"
                width="" height="" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
          </div> <!-- .col-sm-8 -->
        </div> <!-- .row -->

        <h1 class="area-title mt-5">
          <span class="title-text">Query to IsDB-BISEW</span>
        </h1>
        <div class="row">
          <div class="col-sm-10 offset-sm-1">
            <form action="{{url('contact')}}" method="post">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label text-left text-md-right">Name <span
                    class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                    value="{{old('name')}}">
                  @error('name') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label text-left text-md-right">Phone <span
                    class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"
                    value="{{old('phone')}}">
                  @error('phone') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label text-left text-md-right">Subject <span
                    class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject"
                    value="{{old('subject')}}">
                  @error('subject') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label text-left text-md-right">Email <span
                    class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <input type="text" name="email" class="form-control" id="email" placeholder="Email"
                    value="{{old('email')}}">
                  @error('email') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="message" class="col-sm-2 col-form-label text-left text-md-right">Message <span
                    class="text-danger">*</span></label>
                <div class="col-sm-10">
                  <textarea name="message" id="message" rows="4" class="form-control"
                    placeholder="Message">{{old('message')}}</textarea>
                  @error('message') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 captcha"></label>
                <div class="col-sm-10">
                  {!! captcha_img() !!}
                  <input type="text" name="captcha" class="form-control" id="captcha" placeholder=""
                  value="{{old('captcha')}}">
                @error('captcha') <p class="text-danger m-0">{{ $message }}</p> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 invisible">Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-main">Submit</button>
                  <a href="{{url("contact?reset")}}" class="btn btn-red">Reset</a>
                </div>
              </div>
            </form>
          </div>
        </div> <!-- .row -->
      </div> <!-- .col-md-9 -->

      <div class="col-md-3 col-sm-4 py-3">
        <div class="sidebar-widget">
          <h2 class="widget-title"><span>Important Links</span></h2>
          <div class="card-body">
            <ul class="list-group p-0">
              <li class="list-group-item text-left">
                <a href="{{url('latest-updates')}}">Latest Updates</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('notice')}}">Notice</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('it-scholarship-programme')}}">IT Scholarship Programme</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('vocational-training-programme')}}">Vocational Training Programme</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('madrasah-education-programme')}}">Madrasah Education Programme</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('four-year-diploma-scholarship')}}">4-Year Diploma Scholarship Programme</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('orphanage-programme')}}">Orphanage Programme</a>
              </li>
              <li class="list-group-item text-left">
                <a href="{{url('idb-bhaban')}}">IsDB-Bhaban</a>
              </li>
            </ul>
          </div>
        </div> <!-- .sidebar-widget -->
      </div>
    </div>
  </div> <!-- .container -->
</section> <!-- .about-content -->

@endsection

@push('scripts')
<script>
  (function ($) {
      $(".post-content").find("table").addClass("table table-striped table-bordered");
    }(jQuery));
</script>
@endpush