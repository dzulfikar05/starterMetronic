var loadBlock = function(message = 'Loading...') {
    $.blockUI({
        message: `<div class="blockui-message" style="z-index: 99999"><span class="spinner-border text-primary"></span>  </div>`,
        css: {
            border: 'none',
            backgroundColor: 'rgba(47, 53, 59, 0)',
            'z-index': 99999
        }
    });
}

var unblock = function(delay) {
    window.setTimeout(function() {
        $.unblockUI();
    }, delay);
}

// $('.required').append('<span class="text-danger"> *</span>')

var saMessage = function (config) {
    config = $.extend(true, {
        success: false,
        message: 'System error, please contact the Administrator',
        title: 'Failed',
        time: 5000,
        sticky: false,
        allowOutsideClick: true,
        // image: ((config.success) ? './assets/img/success.png' : './assets/img/error.png'),
        callback: function () { },
    }, config);
    if (config.success == true) {
        Swal.fire({
            title: (config.title == "Failed") ? "Success" : config.title,
            text: config.message,
            icon: "success",
            confirmButtonColor: "#3051d3",
            cancelButtonColor: "#f46a6a",
            allowOutsideClick: config.allowOutsideClick,
        }).then(function (result) {
            config.callback(result);
        });
    } else {
        if (config.success == false) {
            Swal.fire({
                title: config.title,
                text: config.message,
                icon: "error",
                confirmButtonColor: "#3051d3",
                cancelButtonColor: "#f46a6a",
                allowOutsideClick: config.allowOutsideClick,
            }).then(function (result) {
                config.callback(result);
            });
        } else {
            Swal.fire({
                title: config.title,
                text: config.message,
                icon: config.success,
                confirmButtonColor: "#3051d3",
                cancelButtonColor: "#f46a6a",
                allowOutsideClick: config.allowOutsideClick,
            }).then(function (result) {
                config.callback(result);
            });
        }
    }

    // config.callback();
};

var saConfirm = function (config) {
    config = $.extend(true, {
        title: 'Information',
        message: null,
        size: 'small',
        type: 'warning',
        confirmLabel: '<i class="fa fa-check"></i> Yes',
        confirmClassName: 'btn btn-focus btn-success m-btn m-btn--pill m-btn--air',
        cancelLabel: '<i class="fa fa-times"></i> No',
        cancelClassName: 'btn btn-focus btn-danger m-btn m-btn--pill m-btn--air',
        showLoaderOnConfirm: false,
        allowOutsideClick: true,
        callback: function () { }
    }, config);
    Swal.fire({
        title: config.title,
        text: config.message,
        icon: config.type,
        confirmButtonText: config.confirmLabel,
        confirmButtonClass: config.confirmClassName,
        reverseButtons: true,
        showCancelButton: true,
        cancelButtonText: config.cancelLabel,
        cancelButtonClass: config.cancelClassName,
        confirmButtonColor: "#3ddc97",
        cancelButtonColor: "#f46a6a",
        allowOutsideClick: config.allowOutsideClick
    }).then(function (result) {
        config.callback(result.value);
    });
};

var toRp = function(angka, num = false) {
    if (angka == "" || angka == 'undefined' || angka == null) {
        angka = 0;
    }
    var hasil = 0;
    try {
        hasil = new Intl.NumberFormat('id-ID').format(angka);
    } catch (e) {
        var rev = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2 = '';
        var zero = num ? ',00' : '';
        for (var i = 0; i < rev.length; i++) {
            rev2 += rev[i];
            if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                rev2 += '.';
            }
        }
        hasil = '' + rev2.split('').reverse().join('') + zero;
    }
    return hasil;
};

var  dateFormat = function (startDate, finishDate) {
    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var start = new Date(startDate);
    var finish = new Date(finishDate);
    
    if (finishDate == undefined) {
        return start.getDate() + " " + monthNames[start.getMonth()] + " " + start.getFullYear();
    } else {
        var mulai = start.getDate() + " " + monthNames[start.getMonth()] + " " + start.getFullYear();
        var mulaiTanpaTahun = start.getDate() + " " + monthNames[start.getMonth()];
        var selesai = finish.getDate() + " " + monthNames[finish.getMonth()] + " " + finish.getFullYear();
        var rentang = start.getFullYear() == finish.getFullYear() ? (start.getMonth() == finish.getMonth() ? start.getDate() + "-" + selesai : mulaiTanpaTahun + "-" + selesai) : mulai + "-" + selesai;
        return rentang;
    }
};
