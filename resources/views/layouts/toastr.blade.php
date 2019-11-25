@if(isset($errors) && count($errors)>0)
    <script>    
        var textword = "{{$errors->first()}}" ;
        toastr.error(textword);
    </script>
@elseif(session('success'))
    <script>    
        var textword = "{{session('success')}}" ;
        toastr.success(textword);
    </script>
@endif