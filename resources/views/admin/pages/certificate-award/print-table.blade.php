<style>
  .table {
    margin-bottom: 0;
    width: 100%;
    max-width: 100%;
    background-color: rgba(0, 0, 0, 0);
    border-collapse: collapse;
    border-spacing: 0;
  }

  .table-bordered {
    border: 1px solid rgb(244, 244, 244);
  }

  .table>thead>tr>th,
  .table>tbody>tr>th,
  .table>thead>tr>td,
  .table>tbody>tr>td {
    vertical-align: middle;
    border-bottom-width: 2px;
    border: 1px solid rgb(244, 244, 244);
    padding: 6px;
    font-size: 10px;
    line-height: 1.42857143;
  }

  .table-striped>tbody>tr:nth-of-type(odd) {
    background-color: rgb(249, 249, 249);
  }

  .text-center {
    text-align: center;
  }
</style>


<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center" width="10%">Trainee ID</th>
      <th width="15%">Name</th>
      <th class="text-center" width="15%">Batch ID</th>
      <th class="text-center" width="12%">Mobile</th>
      <th class="text-center" width="15%">Email</th>
      <th class="text-center" width="15%">Designation</th>
      <th class="text-center" width="15%">Organization</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($register as $item)
    <tr>
      <td class="text-center">{{$item->trainee_id}}</td>
      <td>{{$item->name}}</td>
      <td class="text-center">{{$item->batch_id}}</td>
      <td class="text-center"><a href="tel:{{$item->mobile}}">{{$item->mobile}}</a></td>
      <td class="text-center"><a href="mailto:{{$item->email}}">{{$item->email}}</a></td>
      <td class="text-center">{{$item->designation}}</td>
      <td class="text-center">{{$item->org}}</td>
    </tr>
    @endforeach
  </tbody>
</table>