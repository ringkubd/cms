<form action="{{ url("admin/widget/{$wiget->id}") }}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label class="checkbox-inline">
      <input type="checkbox" name="active" value="1" checked> Active
    </label>
  </div>
  <div class="form-group">
    <label for="title">Wdget title <span class="text-danger">*</span></label>
    <input type="text" name="title" value="{{old('title',$wiget->title)}}" class="form-control" id="title"
      placeholder="widget title">
    @error('title')
    <p class="text-danger margin-bottom-none">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <label for="description">Wdget Description</label>
    <textarea name="description" raw="4" id="description" class="form-control"
      placeholder="Wdget Group">{{old('description',$wiget->description)}}</textarea>
    @error('description')
    <p class="text-danger margin-bottom-none">{{$message}}</p>
    @enderror
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="submit">
    <a href="{{ url("admin/widget/{$wiget->id}/edit") }}" class="btn btn-danger">Reset</a>
  </div>
</form>
