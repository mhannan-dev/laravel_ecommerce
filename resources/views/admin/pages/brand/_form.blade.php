@csrf
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="state_id">Brand name</label><span class="text-danger">*</span>
        <input type="text" value="{{ old('title', $brand->title) }}" name="title"
            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" placeholder="Brand name">
        @if ($errors->has('title'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('title') }}</strong>
            </div>
        @endif
    </div>


</div>
<button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
@push('scripts')
<script type="text/javascript">
    $(function() {

    });

</script>
@endpush
