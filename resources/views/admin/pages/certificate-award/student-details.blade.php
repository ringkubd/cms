<table class="table table-hover">
  <tr>
    <th>Registration Date</th>
    <td>{{date('d-M, Y',strtotime($register->created_at))}}</td>
  </tr>
  <tr>
    <th>Name</th>
    <td>{{$register->name}}</td>
  </tr>
  <tr>
    <th>Email</th>
    <td><a href="mailto:{{$register->email}}">{{$register->email}}</a></td>
  </tr>
  <tr>
    <th>Mobile</th>
    <td><a href="tel:{{$register->mobile}}">{{$register->mobile}}</a></td>
  </tr>
  <tr>
    <th>Father</th>
    <td>{{$register->father}}</td>
  </tr>
  <tr>
    <th>Mother</th>
    <td>{{$register->mother}}</td>
  </tr>
  <tr>
    <th>Attachment Info</th>
    <td>
      @php
      //$path = base_path('../../cert.isdb-bisew.org/public_html/appointment/'.$register->round);
      //$dir = new DirectoryIterator($path);

       // foreach ($dir as $fileinfo) {
         //   $fileName = $fileinfo->getFilename();
         //   $arr = explode('.', $fileName);
         //   if(in_array($register->trainee_id, $arr)) {
         //       $url = 'https://cert.isdb-bisew.org/appointment/'.$register->round.'/'.$fileName;
         //       echo '<a href="'.$url.'" target="_blak">'.$url.'</a> <br>';
        //    }
       // }

      @endphp
    </td>
  </tr>
  <tr>
    <th>Trainee ID</th>
    <td>{{$register->trainee_id}}</td>
  </tr>
  <tr>
    <th>Round</th>
    <td>{{$register->round}}</td>
  </tr>
  <tr>
    <th>Course</th>
    <td>{{$register->course}}</td>
  </tr>
  <tr>
    <th>Batch ID</th>
    <td>{{$register->batch_id}}</td>
  </tr>
  <tr>
    <th>Designation</th>
    <td>{{$register->designation}}</td>
  </tr>
  <tr>
    <th>Organization</th>
    <td>{{$register->org}}</td>
  </tr>
  <tr>
    <th>Salary</th>
    <td>{{$register->salary}}</td>
  </tr>
  <tr>
    <th>Joining Date</th>
    <td>{{web_date($register->joining_date)}}</td>
  </tr>
</table>
