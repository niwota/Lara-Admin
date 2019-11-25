<div class="form-group row">
    <label class="col-sm-2 col-form-label text-right">{{$label ?? '选择输入'}}：</label>
    <div class="col-sm-3">
        <select name="{{$name ?? ''}}" class="form-control select2 {{$class ?? ''}}" {{$attr ?? ''}}>
            <option value="{{$value??''}}">{{$selecthead ?? '请选择'}}</option>
            @foreach ($options??[] as $key=>$item)
                @isset($vk)
                    <option {{$value == $key ? 'selected' : ''}} value="{{$key}}">{{$item}}</option>
                @else
                    <option {{$value == $item ? 'selected' : ''}} value="{{$item}}">{{$item}}</option>
                @endisset
            @endforeach
        </select>
    </div>
</div>