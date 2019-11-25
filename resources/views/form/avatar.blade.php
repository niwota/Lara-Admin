<div class="form-group row">
    <label class="col-sm-2 col-form-label form-check-label text-right">{{$label??'头像'}}：</label>
    <div class="col-sm-1">
        <label class="label" data-toggle="tooltip" data-original-title="点击更换头像" >
            <input type="file" class="sr-only"  id="input-file" accept="image/*">
            <input type="hidden" name="avatar" id="avatar-data" />
            <img src="{{user_avatar($user['avatar']??'')}}" id="avatar" style="width:100%"/>
        </label>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">头像编辑</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="img-container">
            <img id="image" src="/img/user2-160x160.jpg" class="" style="width:100%">
        </div>
        </div>
        <div class="modal-footer">
            <div class="row" style="width:100%">
                <div class="col-sm-7 text-left">
                    <button class="btn btn-primary" data-method="rotate" data-option="-90" type="button"><i class="fas fa-undo-alt"></i> 旋转</button>
                    <button class="btn btn-primary" data-method="rotate" data-option="90" type="button"><i class="fas fa-redo-alt"></i> 旋转</button>
                </div>
                <div class="col-sm-5 text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="crop">确定</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@section('page-script')
<script>
    $(function(){
        var $avatar = $('#avatar');
        var image = document.getElementById('image');
        var $input = $('#input-file');
        var $modal = $('#modal');
        var $avatar_data = $('#avatar-data');
        var cropper;

        //图像更改
        $input.on('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
                image.src = url;
                $input.val('');
                $modal.modal({backdrop:'static',keyboard:false});
            };
            var file;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                }
            }
        });

        //模态框事件
        $modal.on('shown.bs.modal', function () {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
            });
        }).on('hidden.bs.modal', function () {
            cropper.destroy();
            cropper = null;
        });

        //图像旋转
        $('button[data-method="rotate"]').on('click',function(){
            var deg = $(this).data('option')
            cropper.rotate(deg)
        })

        //截图后确定事件
        $('#crop').on('click',function(){
            var canvas;
            var imgsrc;

            $modal.modal('hide');
            if (cropper) {
                canvas = cropper.getCroppedCanvas({
                    width: 160,
                    height: 160,
                });

                imgsrc = canvas.toDataURL();
                $avatar.attr('src',imgsrc);
                $avatar_data.val(imgsrc);
            }
        });
    })
</script>
@endsection
