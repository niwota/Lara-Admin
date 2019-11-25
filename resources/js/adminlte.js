import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import Swal from 'sweetalert2';

const swal = Swal.mixin({
    confirmButtonText:'确定',
    cancelButtonText:'取消',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
});
window.swal = swal;

//require('admin-lte/plugins/jquery-ui/jquery-ui');
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle');
require('admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars');
require('admin-lte/plugins/select2/js/select2.full');
require('cropperjs');
require('admin-lte');
window.toastr = require('toastr');
window.Iconpicker = require('bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min');
window.Cropper = require('cropperjs');

require('admin-lte/dist/js/demo');