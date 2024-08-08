<table class="table table-striped table-bordered" id="certificate-award">
  <thead>
    <tr>
      <th class="text-center" style="width: 90px;">Trainee ID</th>
      <th>Name</th>
      <th class="text-center">Mobile</th>
      <th class="text-center">Email</th>
      <th class="text-center" style="width: 90px;">Batch ID</th>
      <th class="text-center">Organization</th>
      <th class="text-center">Designation</th>
      <th class="text-center">Salary</th>
      <th class="text-center">Joining Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($register as $item)
    <tr>
      <td class="text-center">{{$item->trainee_id}}</td>
      <td> <a href="/admin/certificate-award/{{$item->id}}" class="details"> {{$item->name}} </a></td>
      <td class="text-center"><a href="tel:{{$item->mobile}}">{{$item->mobile}}</a></td>
      <td class="text-center"><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
      <td class="text-center">{{$item->batch_id}}</td>
      <td class="text-center">{{$item->org}}</td>
      <td class="text-center">{{$item->designation}}</td>
      <td class="text-center">{{$item->salary}}</td>
      <td class="text-center" data-sort="{{strtotime($item->joining_date)}}">
        {{date('d-M, Y', strtotime($item->joining_date))}}</td>
    </tr>
    @endforeach
  </tbody>
</table>


{!! dataTableStyle() !!}

{!! dataTableScript("#certificate-award") !!}
