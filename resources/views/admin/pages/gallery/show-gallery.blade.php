@extends('admin.layouts.app')

@section('title', "Show all Pictures")
@inject('admin','App\Admin')

@section('page-title', "Photo Gallery")

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Pictures</li>
  </ol>
@stop

@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@stop

@section('content')

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pictures Data Tables </h3>
            <a href="javascript:void(0)" class="btn-link" data-toggle="collapse" data-target="#filter"
               aria-expanded="false" aria-controls="filter" title="filter">
              <i class="fa fa-filter"></i>
            </a>
            <a href="{{url('admin/type/photo-gallery/create')}}" class="btn-link">Add Pictures</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover">
              <tr class="vertical-middle">
                <th width="10">
                  <label>
                    <input type="checkbox" class="flat-red" id="checkall" value="all">
                  </label>
                </th>
                <th style="width: 200px">Caption</th>
                <th style="width: 120px" class="text-center">Picture</th>
                <th style="width: 180px" class="text-center">Categories</th>
                <th style="width: 120px" class="text-center">Author</th>
                <th style="width: 150px" class="text-center">Date</th>
              </tr>
              @forelse($pictures as $picture)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="checked_post[]" value="{{$picture->id}}" class="flat-red single-check">
                    </label>
                  </td>
                  <td>
                    <span class="post-title">{{$picture->caption}}</span>
                    <p>
                      <a href="JavaScript:void(0);" class="nav-link" data-toggle="modal"
                         data-target="#modal-default-{{$picture->id}}">Edit</a> |
                      <a href="JavaScript:void(0);" class="nav-link text-danger" onclick="del_confirm('{{$picture->id}}')"
                         title="Delete Item"> Delete </a>
                    </p>
                    <form id="{{$picture->id}}" action="{{ url("admin/image-delete/{$picture->id}") }}" method="POST"
                          style="display: none;">
                      @method('delete') @csrf
                    </form>
                  </td>
                  <td class="text-center">
                    <img src="{{asset(thumbs_url($picture->filePath))}}" alt="{{$picture->caption}}" width="100">
                  </td>
                  <td class="text-center">
                    @if($picture->categories)
                      @foreach($picture->categories as $categories)
                        {{$categories->name}}
                        @if(!$loop->last) , @endif
                      @endforeach
                    @endif
                  </td>
                  <td class="text-center">
                    @if($picture->user)
                      {{$picture->user->firstName." ".$picture->user->LastName}}
                    @endif
                  </td>
                  <td class="text-center">
                    <p class="status">{{$picture->post_status}}</p>
                    @if($picture->post_status == "schedule")
                      <p class="date">{{ date("d-m-Y h:i a", strtotime($picture->schedule_time)) }}</p>
                    @elseif($picture->post_status == "draft")
                      <p class="date">{{ date("d-m-Y h:i a", strtotime($picture->created_at)) }}</p>
                    @else
                      <p class="date">{{ date("d-m-Y h:i a", strtotime($picture->created_at)) }}</p>
                    @endif
                  </td>
                </tr>
                <div class="modal fade" id="modal-default-{{$picture->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{$picture->caption}}</h4>
                      </div>
                      <div class="modal-body">
                        <form action="{{url("admin/image-update/{$picture->id}")}}" method="POST"
                              enctype="multipart/form-data">
                          @csrf
                          @method("PUT")
                          <div class="form-group">
                            <label class="checkbox-inline">
                              @php
                                $active = old("active", $picture->is_active) == 1 ? "checked" : null;
                              @endphp
                              <input type="checkbox" name="active" value="1" {{$active}}> Active
                            </label>
                          </div>
                          <div class="row">
                            <div class="col-sm-6">
                              <img src="{{asset(thumbs_url($picture->filePath))}}" alt="{{$picture->caption}}"
                                   class="img-responsive">
                            </div>
                            <div class="col-sm-6">
                              <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                  <a href="#caption-{{$picture->id}}" aria-controls="caption-{{$picture->id}}" role="tab"
                                     data-toggle="tab">Caption</a>
                                </li>
                                <li role="presentation">
                                  <a href="#caption-bn-{{$picture->id}}" aria-controls="caption-bn-{{$picture->id}}"
                                     role="tab" data-toggle="tab">Caption Bangla</a>
                                </li>
                              </ul> <!-- Tab panes -->
                              <div class="tab-content" style="padding-top: 10px">
                                <div role="tabpanel" class="tab-pane active" id="caption-{{$picture->id}}">
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="caption" id="caption"
                                           value="{{old('caption') ?? $picture->caption}}" placeholder="Caption">
                                    @error('caption')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="caption-bn-{{$picture->id}}">
                                  <div class="form-group">
                                    <label>
                                      <input type="text" class="form-control" name="caption_bn" id="caption_bn"
                                             value="{{old('caption_bn') ?? $picture->caption_bn}}" placeholder="Caption Bangla">
                                    </label>
                                    @error('caption_bn')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                  </div>
                                </div>
                              </div> <!-- .tab-content -->
                              <div class="form-group">
                                <label class="radio-inline">
                                  <input type="radio" name="post_status" value="publish" class="checking"
                                         data-target="scheduleDate1" checked> Publish
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="post_status" value="draft" class="checking"
                                         data-target="scheduleDate2" @if($picture->post_status == 'draft') checked @endif> Draft
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="post_status" value="schedule" class="checking"
                                         data-target="scheduleDate-{{$picture->id}}" @if($picture->post_status == 'schedule')
                                           checked @endif> Schedule
                                </label>
                                <div class="form-group @if($picture->post_status != 'schedule') hide @endif scheduleDate"
                                     id="scheduleDate-{{$picture->id}}">
                                  <div class="form-group">
                                    <label for="scheduleTime" class="hide"></label>
                                    @php
                                      $date = !empty($picture->schedule_time) ? date("d-m-Y",
                                      strtotime($picture->schedule_time)) : date("d-m-Y");
                                    @endphp
                                    <label>
                                      <input type='text' value="{{old('scheduleTime',$date )}}" name="scheduleTime"
                                             class="form-control scheduleTime" />
                                    </label>
                                  </div>
                                </div> <!-- .scheduleDate -->
                              </div>
                            </div>
                          </div> <!-- row -->
                          <div class="row">
                            <div class="col-sm-12">
                              @php
                                $moduleInfo = $admin->get_module_by_slug('photo-gallery');
                                $terms = $admin->get_module_terms($moduleInfo->id);
                                $module = $moduleInfo->slug;
                              @endphp
                              @foreach ($terms as $term)
                                @php $taxoModule = 0 @endphp
                                <div class="catblock">
                                  <h5>{{ $term->name }}</h5>
                                  <ul class="post_taxonomy">
                                    @foreach ( $admin->find_post_taxonomies($term->slug, $taxoModule, 0) as $item)
                                      <li>
                                        <label class="checkbox-inline">
                                          @php
                                            $item = isset($item) ? $item : "";
                                            $pic_cats = App\Models\ContentModels\gallery::get_pictures_cats($picture->id);
                                            $oldTaxonomy = old('taxonomy') ?? array();
                                            $inCats = $pic_cats->contains('id', $item->id);
                                            $checked = $inCats || in_array($item->id, $oldTaxonomy) ? "checked" : null;
                                          @endphp
                                          <input type="hidden" name="oldTaxonomy[]" value="{{$item->id}}">
                                          <input type="checkbox" name="taxonomy[]" value="{{$item->id}}" {{$checked}}>
                                          {{$item->name }}
                                        </label>
                                        @php
                                          $firstItems = $admin->find_post_taxonomies($item->term, $taxoModule, $item->id);
                                        @endphp
                                        @if ($firstItems->first())
                                          <ul>
                                            @foreach ( $firstItems as $firstItem)
                                              <li>
                                                @php
                                                  $firstItem = isset($firstItem) ? $firstItem : "";
                                                  $inCats = $pic_cats->contains('id', $firstItem->id);
                                                  $checked = $inCats || in_array($firstItem->id, $oldTaxonomy) ? "checked" : null;
                                                @endphp
                                                <label class="checkbox-inline">
                                                  <input type="hidden" name="oldTaxonomy[]" value="{{$firstItem->id}}">
                                                  <input type="checkbox" name="taxonomy[]" value="{{$firstItem->id}}" {{$checked}}>
                                                  {{$firstItem->name}}
                                                </label>
                                                @php
                                                  $secondItems = $admin->find_post_taxonomies($firstItem->term, $taxoModule,
                                                  $firstItem->id);
                                                @endphp
                                                @if ($secondItems->first())
                                                  <ul>
                                                    @foreach ( $secondItems as $secondItem)
                                                      <li>
                                                        @php
                                                          $secondItem = isset($secondItem) ? $secondItem : "";
                                                          $inCats = $pic_cats->contains('id', $secondItem->id);
                                                          $checked = $inCats || in_array($secondItem->id, $oldTaxonomy) ? "checked" :
                                                          null;
                                                        @endphp
                                                        <label class="checkbox-inline">
                                                          <input type="hidden" name="oldTaxonomy[]" value="{{$secondItem->id}}">
                                                          <input type="checkbox" name="taxonomy[]" value="{{$secondItem->id}}"
                                                            {{$checked}}>
                                                          {{$secondItem->name}}
                                                        </label>
                                                      </li>
                                                    @endforeach
                                                  </ul>
                                                @endif
                                              </li>
                                            @endforeach
                                          </ul>
                                        @endif
                                      </li>
                                    @endforeach
                                  </ul>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          <button type="submit" class="btn btn-primary pull-left">Save changes</button>
                          <br>
                        </form>
                      </div>
                    </div> <!-- /.modal-content -->
                  </div> <!-- /.modal-dialog -->
                </div> <!-- /.modal -->

              @empty
                <tr>
                  <td colspan="5">No post data</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $pictures->links() }}
            </div>
          </div> <!-- /.box box-footer -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-7 -->
    </div>
    <!--/.row -->

  </section>

@stop

@section("custom-style")
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@stop

@section('custom-script')
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $(function () {
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
      // check uncheck all
      icheck_iuncheck("input#checkall", "input.single-check");

      $('.scheduleTime').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
      });

      $(".checking").click(function () {
        let check = $(this).val();
        let target = $(this).attr("data-target");
        if (check === "schedule") {
          $(".scheduleDate").addClass("hide");
          $("#" + target).removeClass("hide");
        } else {
          $(".scheduleDate").addClass("hide");
        }
      });

    });

  </script>

@stop
