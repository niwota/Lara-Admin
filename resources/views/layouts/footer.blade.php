  <footer class="main-footer">
    <strong>Copyright &copy; 2019 - {{date('Y')}} <a href="#">{{config('app.name')}}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script src="{{mix('js/app.js')}}"></script>

@yield('page-script')

@include('layouts.toastr')
</body>
</html>