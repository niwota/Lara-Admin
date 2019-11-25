$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.select2').select2();

    $('[data-toggle="tooltip"]').tooltip();

    $('#password').on('keyup', checkPasswordConfirm)
    $('#password_confirmation').on('keyup', checkPasswordConfirm)

    $('.needs-validation').attr('novalidate', true);

    $('.needs-validation').on('submit', function (event) {
        if ($(this)[0].checkValidity() === false) {
            $(this).addClass('was-validated')
            event.preventDefault();
            event.stopPropagation();
            $(this)[0].reportValidity();
            return false;
        }
    })

    $('.nav-sidebar a').each(function (index, item) {
        let pathname = window.location.pathname;
        let menu_link = $(item)[0].pathname;
        console.log(menu_link);


        if ($(item).attr('href') != '#' && pathname.indexOf(menu_link) != -1) {
            $(item).parents('.nav-item').addClass('menu-open');
            $(item).addClass('active')
            $(item).parents('.has-treeview').find('.p-menu').addClass('active');
        }
        if ($(item).hasClass('active')) {
            if (menu_link == '/' && pathname != menu_link){
                $(item).removeClass('active');
                $(item).parents('.nav-item').removeClass('menu-open');
                return;
            }

            if ($(item).attr('href') != '#' && menu_link == pathname) {
                $(item).parents('.nav-treeview').find('a').removeClass('active');
                $(item).addClass('active');
                return false;
            }
        }
    })

    $('.delete').on('click', function () {
        var url = $(this).data('src');
        sweetConfirm(url, 'post', { _method: 'DELETE' });
    })

    $('input[type="checkbox"]').on('click', function (e) {

        checked = $(this).prop("checked");
        var container = $(this).parent().parent();

        container.find('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });
        checkSiblings(container);
    });

    $('.btn-all').on('click', function () {
        $('.permission-sel input[type="checkbox"]').prop("checked", true)
        $('.permission-sel input[type="checkbox"]').attr('checked')
    })

    $('.btn-none').on('click', function () {
        $('.permission-sel input[type="checkbox"]').prop("checked", false)
        $('.permission-sel input[type="checkbox"]').removeAttr('checked')
    })

   
})


function sweetConfirm(url, type, query) {
    swal.fire({
        text: '确定该操作吗？',
        type: 'warning',
        showCancelButton: true,
    }).then((res) => {
        if (res.value) {
            $.ajax({
                url: url,
                type: type,
                data: query,
                dataType: 'json'
            }).done(function (res) {
                if (res.msg == 'success') {
                    swal.fire({ text: "操作成功", type: "success" }).then((val) => {
                        window.location.reload();
                    });
                } else {
                    swal.fire({ title: "操作失败！", text: res.errmsg, type: "error" });
                }
            });
        }
    });
}

function checkSiblings(el) {

    var parent = el.parent().parent(),
        all = true;
    el.siblings().each(function () {
        return all = ($(this).children().children('input[type="checkbox"]').prop("checked") === checked);
    });

    if (all && checked) {
        parent.children().children('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: checked
        });

        checkSiblings(parent);

    } else if (all && !checked) {
        parent.children().children('input[type="checkbox"]').prop("checked", checked);
        parent.children().children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
        checkSiblings(parent);

    } else {
        el.parents("li").children().children('input[type="checkbox"]').prop({
            indeterminate: false,
            checked: true
        });

    }
}

function checkPasswordConfirm() {
    let password = $('#password');
    let password_confirmation = $('#password_confirmation');
    if (password.val() != password_confirmation.val()) {
        password[0].setCustomValidity('密码和确认密码不一致');
        password_confirmation[0].setCustomValidity('密码和确认密码不一致');
    } else {
        password[0].setCustomValidity('');
        password_confirmation[0].setCustomValidity('');
    }
}