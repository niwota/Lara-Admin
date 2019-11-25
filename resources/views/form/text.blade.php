<div class="form-group row">
    <label class="col-sm-2 col-form-label form-check-label text-right">{{$label}}：</label>
    <div class="col-sm-8">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas {{(isset($type) && $type == 'email') ? 'fa-envelope' : 'fa-pen'}} fa-fw"></i>
                </span>
            </div>
            <input {{isset($id)? 'id='.$id :''}} type="{{$type ?? 'text'}}" name="{{$name}}" value="{{$value}}" class="form-control {{$class ?? ''}}" {{$attr ?? ''}}  >
        </div>
        
    </div>

</div>