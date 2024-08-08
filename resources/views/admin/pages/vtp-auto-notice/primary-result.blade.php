<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>
<body>


<div class="container">
  <table>
    <tr>
      <td><input id="tblSearch" type="text" class="form-control" placeholder="Search.."></td>
    </tr>
  </table>
  <table id="tblResult" class="table table-bordered table-striped table-sm">
    <tr>
      @php($i = 1)
      @foreach($results as $result)
        <td>{{$result->trainee_id}}</td>
        <td>{{$result->name}}</td>
        @if($i % 3 == 0)
    </tr>
    <tr>
      @endif
      @php($i++)
      @endforeach
    </tr>
  </table>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script !src="">
  $("#tblSearch").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#tblResult tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });


</script>

</body>
</html>



