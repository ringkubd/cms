@inject('home', "App\Home")
<!-- Main Footer -->
<footer class="footer-section d-print-none">
  <div class="container">
    <div class="row pt-sm-5 pb-sm-4">
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center text-sm-left">
        <h2 class="widget-title border-bottom">Address</h2>
        <ul class="footer-widget list-group m-0 m-sm-auto">
          <li>IDB Bhaban (4th Floor)</li>
          <li>E/8-A, Rokeya Sharani, Sher-e-Bangla Nagar. Dhaka-1207, Bangladesh</li>
          <li>
            <span>Phone: </span>
            <a href="tel:+88029183006" class="isdb-email">+880 2 9183006</a>
          </li>
          <li>
            <span>Email: </span>
            <a href="mailto:idbb@isdb-bisew.org" class="isdb-email">idbb@isdb-bisew.org</a>
          </li>
          <li>
            <span>Fax: </span>
            <span>+880 2 9183001 - 2</span>
          </li>
        </ul>
      </div> <!-- /.col-sm-3 -->
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center text-sm-left">
        <h2 class="widget-title border-bottom">IsDB-BISEW Programme</h2>
        <ul class="footer-widget list-group m-0 m-sm-auto">
          <li>
            <a href="/it-scholarship-programme" class="nav-link">IT Scholarship Programme</a>
          </li>
          <li>
            <a href="/vocational-training-programme" class="nav-link">Vocational Training</a>
          </li>
          <li>
            <a href="/madrasah-education-programme" class="nav-link">Madrasah Programme</a>
          </li>
          <li>
            <a href="/four-year-diploma-scholarship" class="nav-link">4-Year Diploma Programme</a>
          </li>
          <li>
            <a href="/orphanage-programme" class="nav-link">Orphanage Programme</a>
          </li>
          <li>
            <a href="/forms" class="nav-link">Necessary Forms</a>
          </li>
        </ul>
      </div> <!-- /.col-sm-3 -->
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center text-sm-left">
        <h2 class="widget-title border-bottom">Important Links</h2>
        <ul class="footer-widget list-group m-0 m-sm-auto">
          <li>
            <a href="http://pis.isdb-bisew.org/login" class="nav-link" target="_blank">Project Information System for
              VTP</a>
          </li>
          <li>
            <a href="http://isdb-bisew.info" class="nav-link" target="_blank">Project Information System for ITP</a>
          </li>
          <li>
            <a href="http://careerhub.isdb-bisew.info/" class="nav-link" target="_blank">CareerHub IsDB-BISEW</a>
          </li>
          <li>
            <a href="http://tms.isdb-bisew.info/" class="nav-link" target="_blank">TSPs Monitoring System</a>
          </li>
          <li>
            <a href="http://tenant.isdb-bisew.org/" class="nav-link" target="_blank">IsDB-BISEW Tenant</a>
          </li>
          <li>
            <a href="/contact" class="nav-link">Contact us</a>
          </li>
        </ul>
      </div> <!-- /.col-sm-3 -->
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4 text-center text-sm-left">
        <h2 class="widget-title border-bottom">Connect</h2>
        <ul class="footer-widget list-group social m-0 m-sm-auto">
          <li>
            @php
            $facebook = $home->get_settings('facebook_url', true);
            @endphp
            @if($facebook)
            <a class="blank facebook" href="{{$facebook}}" target="_blank" title="facebook">
              <i class="fa fa-facebook"></i>
            </a>
            @endif
            @php
            $linkedin = $home->get_settings('linkedin_url', TRUE);
            @endphp
            @if($linkedin)
            <a class="blank linkedin" href="{{$linkedin}}" target="_blank" title="linkedIn">
              <i class="fa fa-linkedin"></i>
            </a>
            @endif
            @php
            $youtube = $home->get_settings('youtube_url', TRUE);
            @endphp
            @if($youtube)
            <a class="blank youtube" href="{{$youtube}}" target="_blank" title="YouTube">
              <i class="fa fa-youtube"></i>
            </a>
            @endif
          </li>
        </ul>
      </div> <!-- /.col-sm-3 -->
    </div>
  </div>

  <div class="copyrighted ">
    <div class="container">
      <p>&copy; {{date("Y")}} IsDB-BISEW All rights reserved
      </p>
    </div> <!-- /.container -->
  </div> <!-- /.copyrighted -->
</footer>

<!---
Design and Developed by
Md. Shafiqul Islam Sumon
portfolio: sumontech.com
-->
