<script>
    var form = 'form_login';

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
    onLogin = () => {
        loadBlock();
        var formData = new FormData($(`[name="${form}"]`)[0]);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('login/authentication') }}",
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
                    location.reload()
                }
            }
        })
    }
</script>
