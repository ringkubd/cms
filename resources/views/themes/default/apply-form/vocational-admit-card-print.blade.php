@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', 'Vocational Training Programme Download Admit Card')

@section('content')


@isset($download)
<style>
  .table {
    color: #000 !important;
  }

  .table-bordered,
  .table-bordered td,
  .table-bordered th {
    border: 1px solid rgba(142, 142, 142, 1) !important;
  }
</style>
@endisset

<section class="contact-section">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-8 py-3">
        <div id="canvas"></div>
        <div class="text-center">
          <button role="button" class="btn btn-default d-inline" id="print">
            <i class="fa fa-print"></i> Print
          </button>
          <a class="btn btn-default d-inline" href="{{ url('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-download" aria-hidden="true"></i>
            {{ __('Download') }}
          </a>
          <form id="logout-form" action="{{ url('vocational-training-programme/download') }}" method="POST"
            style="display: none;">
            @csrf
            <input type="hidden" name="trainee_id" id="trainee_id" value="{{$applyData->trainee_id}}">
          </form>
        </div>
        <div id="printContent" class="vt_admin_card">
          <div class="card card-success">
            <div class="card-header text-center">
              <div class="text-center">
                <img src="{{asset("img/logo.png")}}" alt="IsDB-BISEW" class="logo-img">
              </div>
              <p class="vt_title text-center">
                IsDB-BISEW Vocational Training Programme
              </p>
              <p class="vt_title sub_title text-center">
                Admit Card
              </p>
            </div> <!-- .card-header -->
            <div class="card-body">
              <table class="table table-bordered" border="1">
                <tbody>
                  <tr>
                    <td>Round</td>
                    <td>{{$applyData->round}}</td>
                    <td rowspan="5" style="text-align: center; vertical-align: middle;">
                      <img src="{{$candidateImage}}" class="candidate-img" height="150" width="150">
                    </td>
                  </tr>
                  <tr>
                    <td>Applicant ID</td>
                    <td>{{$applyData->trainee_id}}</td>
                  </tr>
                  <tr>
                    <td>Applicant Name</td>
                    <td>{{$applyData->name}}</td>
                  </tr>
                  <tr>
                    <td>Father's Name</td>
                    <td>{{$applyData->father_name}}</td>
                  </tr>
                  <tr>
                    <td>Mobile Number</td>
                    <td>{{$applyData->mobile_number}}</td>
                  </tr>
                </tbody>
              </table>
            </div> <!-- .card-body -->
            <div class="card-body">
              <ul type="circle">
                <li>পরীক্ষার্থীকে অবশ্যই এই প্রবেশপত্রটি (Admit Card) সংরক্ষণ করতে হবে।</li>
                <li>পরীক্ষার্থীকে পরীক্ষার সময় অবশ্যই এই প্রবেশপত্র এবং সকল পরীক্ষার মূল সার্টিফিকেট সঙ্গে আনতে হবে।
                </li>
                <li>পরীক্ষার সময় ও নির্বাচিত প্রাথী তালিকা <span>http://isdb-bisew.org </span> ওয়েবসাইট এ প্রকাশিত হবে।</li>
                <li>পরীক্ষার স্থান: আই ডি বি ভবন (৪র্থ তলা), ই/৮-এ রোকেয়া সরণী, আগারগাঁও, ঢাকা।</li>
              </ul>
            </div> <!-- .card-body -->
          </div>
          <div class="logo-brief">
            <p class="text-center m-0">
              Islamic Development Bank Bangladesh Islamic Solidarity Educational Wakf (IsDB-BISEW)
            </p>
            <p class="text-center">
              IDB Bhaban (4th Floor), E/8-A, Rokeya Sharani, Sher-e-Bangla Nagar, Dhaka-1207, Bangladesh,
              Phone: +880 2 9183006, Fax: +880 2 9183001 - 2, Email: idbb@isdb-bisew.org
            </p>
          </div> <!-- .logo-brief -->
        </div> <!-- printContent -->
      </div> <!-- .col-md-9 -->
      <div class=" col-md-3 col-sm-4 py-3 d-print-none">
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




@push('scripts')
<script src="{{ asset("themes-assets/default/js/print/print.min.js") }}"></script>
@isset($download)
{{--    <script src="{{asset('js/html2canvas.min.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script>
  const trainee_id = $("#trainee_id").val();
  html2canvas(document.getElementById('printContent'), {
    onrendered: function (canvas) {
      const imgData = canvas.toDataURL();
      const doc = new jsPDF('p', 'mm', [297, 210]); //210mm wide and 297mm high = a4 paper
      doc.setPage(1);
      doc.addImage(imgData, 'JPG', 10, 15, 190, 150); // 190 width and height 160
      doc.save(trainee_id + '.pdf');
    }
  });
</script>
@endisset
<script>
  $(function () {
      $("#print").click(function () {
        printJS({
          printable: 'printContent',
          type: 'html',
          css: '{{asset("themes-assets/default/js/print/print.min.css")}}',
          honorColor: true,
          // style: ".table td, .card-body li, .logo-brief p {font-size: 18px}",
        });
      });
    })
</script>
@endpush
