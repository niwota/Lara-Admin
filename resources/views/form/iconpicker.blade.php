<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right">{{$label ?? 'Icon'}}：</label>
    <div class="col-sm-8">
        <div class="input-group">
            <span class="input-group-prepend">
                <button class="btn btn-secondary" id="icon-picker"  data-icon="{{$value?:'far fa-circle'}}" ></button>
            </span>
            <input type="text" name="{{$name??'icon'}}" id="icon-input" class="form-control" value="{{$value?:'far fa-circle'}}" readonly>
        </div>
    </div>
</div>

@section('page-script')
    <script>
        $('#icon-picker').iconpicker({
            rows: 6,
            cols: 7,
        }).on('change',function(e){
            $('#icon-input').val(e.icon);
        });

    </script>
@endsection