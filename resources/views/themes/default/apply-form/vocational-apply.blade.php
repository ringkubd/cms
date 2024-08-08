@extends('themes/default/layouts/master')

@inject('home', 'App\Home')
@inject('apply', 'App\Models\VocationalModels\VocationalApply')

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
        <div class="col-md-9 col-sm-8 py-3">
          <div class="card">
            <div class="card-header">
              <div class="form-header text-center">
                <h1 class="single-title">Apply for Vocational Training Programme </h1>
                <h3 class="round-name py-2 m-0">Round - {{$vtpIntake->round}}</h3>
                <a href="{{url('vocational-training-programme/admit-card')}}">
                  <i class="fa fa-download" aria-hidden="true"></i> Already applied download admit card
                </a>
                <p class="text-danger">{{request()->session()->get('error')}}</p>
              </div>
            </div>
            <div class="card-body">
              <div class="post-content">
                <form action="{{url('vocational-training-programme/apply')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="name">Full Name <span class="text-danger">*</span></label>
                      <input type="text" name="name" value="{{old('name')}}" id="name"
                             class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                      @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="mobile_number">Mobile number <span class="text-danger">*</span></label>
                      <input type="text" max="12" name="mobile_number" value="{{old('mobile_number')}}" id="mobile_number"
                             class="form-control @error('mobile_number') is-invalid @enderror" placeholder="01XXXXXXXXX">
                      @error('mobile_number') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="birth_date">Date of birth <span class="text-danger">*</span></label>
                      <input type="text" name="birth_date" value="{{old('birth_date')}}" id="birth_date"
                             class="form-control @error('birth_date') is-invalid @enderror" placeholder="DD-MM-YYYY"
                             autocomplete="off">
                      @error('birth_date') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="guardian_mobile">Guardian contact number <span class="text-danger">*</span></label>
                      <input type="text" name="guardian_mobile" value="{{old('guardian_mobile')}}" id="guardian_mobile"
                             class="form-control @error('guardian_mobile') is-invalid @enderror"
                             placeholder="01XXXXXXXXX, 01XXXXXXXXX">
                      @error('guardian_mobile') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="father_name">Father's Name <span class="text-danger">*</span></label>
                      <input type="text" name="father_name" value="{{old('father_name')}}" id="father_name"
                             class="form-control @error('father_name') is-invalid @enderror" placeholder="Father's Name">
                      @error('father_name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="mother_name">Mother's Name <span class="text-danger">*</span></label>
                      <input type="text" name="mother_name" value="{{old('mother_name')}}" id="mother_name"
                             class="form-control @error('mother_name') is-invalid @enderror" placeholder="Mother's Name">
                      @error('mother_name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="education">Education <span class="text-danger">*</span></label>
                      <select class="form-control @error('education') is-invalid @enderror" id="education"
                              name="education">
                        <option value="">Your educational qualification</option>
                        @foreach ($apply->vt_apply_study_label() as $key => $value)
                          <option value="{{$key}}" @if(old('education')==$key) selected @endif>
                            {{$value}}</option>
                        @endforeach
                      </select>
                      @error('education') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="gpa">GPA/Marks <span class="text-danger">*</span></label>
                      <input type="text" name="gpa" value="{{old('gpa')}}" id="gpa"
                             class="form-control @error('gpa') is-invalid @enderror" placeholder="GPA/Marks">
                      @error('gpa') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="roll">Roll Number <span class="text-danger">*</span></label>
                      <input type="text" name="roll" value="{{old('roll')}}" id="roll"
                             class="form-control @error('roll') is-invalid @enderror" placeholder="Roll Number">
                      @error('roll') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="passing_year">Passing Year <span class="text-danger">*</span></label>
                      <select class="form-control @error('passing_year') is-invalid @enderror" id="passing_year"
                              name="passing_year">
                        <option value="">Passing Year</option>
                        @php $year = date("Y"); @endphp
                        @for ( $i = 0; $i < 20; $i++ ) <option value="{{$year}}" @if(old('passing_year')==$year) selected
                          @endif>{{$year}}</option>
                        @php $year -= 1 @endphp
                        @endfor
                      </select>
                      @error('passing_year') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="present_status">Present Status <span class="text-danger">*</span></label>
                      <select class="form-control @error('present_status') is-invalid @enderror" id="present_status"
                              name="present_status">
                        <option value="">Present Status</option>
                        @php $present_status = old('present_status'); @endphp
                        <option value="Studying" @if($present_status=='Studying' ) selected @endif>Studying</option>
                        <option value="Employed" @if($present_status=='Employed' ) selected @endif>Employed</option>
                        <option value="Agriculture" @if($present_status=='Agriculture' ) selected @endif>Agriculture
                        </option>
                        <option value="Unemployed" @if($present_status=='Unemployed' ) selected @endif>Unemployed</option>
                      </select>
                      @error('present_status') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="studying_level">Present Studying Level</label>
                      <select class="form-control @error('studying_level') is-invalid @enderror" id="studying_level"
                              name="studying_level" disabled>
                        <option value="">Studing Level</option>
                        @foreach ($apply->vt_apply_study_label() as $key => $value)
                          <option value="{{$key}}" @if(old('studying_level')==$key) selected @endif>
                            {{$value}}</option>
                        @endforeach
                      </select>
                      @error('studying_level')<div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="religion">Religion <span class="text-danger">*</span></label>
                      <select class="form-control @error('religion') is-invalid @enderror" id="religion" name="religion">
                        <option value="">Religion</option>
                        <option value="islam" @if(old('religion')=='islam' ) selected @endif>
                          Islam
                        </option>
                        <option value="other" @if(old('religion')=='other' ) selected @endif>
                          Other
                        </option>
                      </select>
                      @error('religion') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="gender">Gender <span class="text-danger">*</span></label>
                      <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                        <option value="">Gender</option>
                        <option value="male" @if(old('gender')=='male' ) selected @endif>Male
                        </option>
                      </select>
                      @error('gender')<div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="martial_status">Marital Status <span class="text-danger">*</span></label>
                      <select class="form-control @error('martial_status') is-invalid @enderror" id="martial_status"
                              name="martial_status">
                        <option value="">Marital Status</option>
                        <option value="married" @if(old('martial_status')=='married' ) selected @endif>Unmarried
                        </option>
                        <option value="unmarried" @if(old('martial_status')=='unmarried' ) selected @endif>Married
                        </option>
                      </select>
                      @error('martial_status') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="reference">Reference</label>
                      <input type="text" name="reference" value="{{old('reference')}}"
                             class="form-control @error('reference') is-invalid @enderror" placeholder="Reference Name"
                             id="reference">
                      @error('reference') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="pres_address">Present Address <span class="text-danger">*</span></label>
                      <textarea class="form-control @error('pres_address') is-invalid @enderror"
                                placeholder="Your present address" rows="3" name="pres_address"
                                id="pres_address">{{old('pres_address')}}</textarea>
                      @error('pres_address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-md-6">
                      <label for="perm_address">Permanent Address <span class="text-danger">*</span></label>
                      <textarea name="perm_address" class="form-control @error('perm_address') is-invalid @enderror"
                                rows="3" placeholder="Your permanent address" id="perm_address">{{old('perm_address')}}</textarea>
                      @error('perm_address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->

                    <div class="form-group col-6 col-sm-3">
                      <label for="thumbnail" title="Select Image"> Upload Picture <span class="text-danger">*</span><br>
                        <img src="{{asset('img/default-avatar.png')}}" title="select picture" id="holder"
                             class="img-fluid user-picture w-75">
                        <p class="m-0 text-info" style="line-height: 1.4;">Image must be .jpg, .jpeg format. Max Size
                          150kb</p>
                      </label>
                      <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror d-none"
                             id="thumbnail">
                      @error('photo') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div> <!-- .form-group -->
                  </div> <!-- .row -->

                  <div class="form-group">
                    <input type="submit" value="Apply" class="btn btn-main">
                  </div> <!-- .form-group -->
                </form>
              </div> <!-- .post-content -->
            </div> <!-- .card-body -->
          </div> <!-- .card -->
        </div> <!-- .col-md-9 -->

        <div class="col-md-3 col-sm-4 py-3">
          <div class="sidebar-widget mb-4">
            <h2 class="widget-title"><span>Related Topics</span></h2>
            <ul class="widget-list">
              @php
                $related_posts = $home->get_related_page($module->slug, 15);
              @endphp
              @foreach($related_posts as $r_posts)
                @php
                  $r_posts = isset($r_posts) ? $r_posts : "";
                  if($r_posts->post_format !== "individual"){
                  $link = url($r_posts->post_format."/".$r_posts->post_slug);
                  }else{
                  $link = url($r_posts->post_slug);
                  }
                @endphp
                <li class="item">
                  <a class="item-link" href="{{$link}}">{{$r_posts->post_title}}</a>
                </li>
              @endforeach
            </ul>
          </div> <!-- .sidebar-widget -->
        </div>
      </div>
    </div> <!-- .container -->
  </section> <!-- .about-content -->
@stop

@push('styles')
  <link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
  <style>
    .user-picture {
      cursor: pointer;
      border: 1px solid rgb(204, 204, 204);
      border-radius: 2px;
      margin: 5px 0;
    }
  </style>
@endpush


@push('scripts')
  <script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
  <script>
    $(document).on('change', '#present_status', function () {
      let followed = $('#studying_level');
      if ($(this).val() === 'Studying') {
        followed.removeAttr("disabled");
      } else {
        followed.attr("disabled", "");
      }
    });

    function preview_select_picture(input, preview) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          $(preview).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#thumbnail").change(function () {
      preview_select_picture(this, "#holder");
    });

    $(function () {
      if ($("#present_status").val() === "Studying") {
        $("#studying_level").removeAttr("disabled");
      }
      $('#birth_date').datepicker({
        format: "dd-mm-yyyy",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
        top: 300
      });
    })

  </script>
@endpush
