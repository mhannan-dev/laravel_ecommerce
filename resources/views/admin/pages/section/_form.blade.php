@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="state_id">Section name</label><span class="text-danger">*</span>
        <input type="text" value="{{ old('title', $section->title) }}" name="title"
            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" placeholder="Section title">
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </div>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="status">Status</label> <span class="text-danger">*</span>
        <select name="status" class="form-control" id="status">
          <option>Select status</option>
          <option value="1" {{( $section->status == "1" )? "selected": " "}}>Active</option>
          <option value="0" {{( $section->status == "0" )? "selected": " "}}>InActive</option>
        </select>
                                  </div>

</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
@push('scripts')
<script type="text/javascript">
    $(function() {
        
    });

</script>
@endpush
