<script>
    var form = 'form_register';

    $(() => {
        $('#toggle_password').click(function() {
            if ('password' == $('#password').attr('type')) {
                $('#password').prop('type', 'text');
                $('#iconPassword').removeClass("fa-eye-slash");
                $('#iconPassword').addClass("fa-eye");
            } else {
                $('#password').prop('type', 'password');
                $('#iconPassword').addClass("fa-eye-slash");
                $('#iconPassword').removeClass("fa-eye");
            }
        });
    })
    onRegister = () => {
        loadBlock();
        var formData = new FormData($(`[name="${form}"]`)[0]);
        // console.log(formData); return;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('register/store') }}",
            data: formData,
            method: 'post',
            processData: false,
            contentType: false,
            success: function(res) {
                unblock();
                if (res['success'] == false) {
                    saMessage({
                        message: res['message'],
                        callback: function(res) {
                            if (res) {
                                location.reload()
                            }
                        }
                    });
                } else {
                    window.location.href = "/login";
                    window.location.href = "{{ route('login')}}";

                    // location.reload()
                }
            }
        })
    }
</script>
