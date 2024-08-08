@if(session('success'))
    <div class="alert alert-success custom-alert alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger custom-alert alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        {{session('error')}}
    </div>
@endif

@if(session('errors'))
    <div class="alert alert-warning custom-alert alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
        Form validation error
    </div>
@endif