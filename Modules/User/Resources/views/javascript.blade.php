<script>
    var table = 'table_user';
    var form = 'form_user';
    var fields = [
        'user_id',
        'user_nama',
        'user_username',
        'user_email',
        'user_password',
        // 'user_photo',
        'user_active',
        'user_role',
    ];

    $(() => {
        $("#user_photo").change(function() {
            readURL(this);
        });

        $('#user_role').select2({
            dropdownParent: $('.viewForm')
        });

        loadBlock();
        initTable();
        onCombobox();
    })

    showForm = () => {
        $('.viewForm').modal('show')
        $('#user_password').val('').attr('placeholder', 'Password');
    }

    initTable = () => {
        var table = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            searchAble: true,
            searching: true,
            columnDefs: [
                {"className": "dt-center", "targets": "_all"}
            ],
            paging: true,
            "bDestroy": true,
            ajax: "{{ route('user/table') }}",
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
                {
                    data: 'user_nama',
                    name: 'user_nama',
                    render: function(data, type, full, meta) {
                        var image = '';
                        if (full.user_photo) {
                            image += `<?= asset('storage/uploads/user/`+full.user_photo+`') ?>`
                        } else {
                            image += `<?= asset('assets/user.png') ?>`
                        }

                        return `
                            <div>
                                <div class="col-12">
                                    <img src="${image}" class="rounded-3" style="width: 50px;" height="50px" alt="Avatar" />
                                </div>
                                <div class="col-12">
                                    <span>${full.user_nama?full.user_nama:''}</span>
                                </div>
                            </div>
                            `;
                    }
                },
                {
                    data: 'user_username',
                    name: 'user_username',
                    render: function(data, type, full, meta) {
                        return `<span>${full.user_username?full.user_username:''}</span>`;
                    }
                },
                {
                    data: 'user_email',
                    name: 'user_email',
                    render: function(data, type, full, meta) {
                        return `<span>${full.user_email?full.user_email:''}</span>`;
                    }
                },
                {
                    data: 'user_active',
                    name: 'user_active',
                    render: function(data, type, full, meta) {
                        var status = '';
                        if (full.user_active == 1) {
                            status += `<span class="badge bg-success">Active</span>`;
                        } else {
                            status += `<span class="badge bg-danger">Non Active</span>`;
                        }
                        return status;
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        unblock()
    }

    onSave = () => {
        var formData = new FormData($(`[name="${form}"]`)[0]);

        var id_user = $('#user_id').val();
        var urlSave = "";

        if (id_user == '' || id_user == null) {
            urlSave += "{{ route('user/store') }}";
        } else {
            urlSave += "{{ route('user/update') }}";
        }

        saConfirm({
            message: 'Apakah anda yakin untuk mengubah data?',
            callback: function(res) {
                if (res) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: urlSave,
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            // JSON.parse(res);
                            location.reload()

                            $('.viewForm').modal('hide');
                            onReset();
                            saMessage({
                                success: res['success'],
                                title: res['title'],
                                message: res['message'],
                                callback:function(){
                                    initTable();
                                }
                            })
                        }
                    })
                }

            }
        })
    }

    onEdit = (el) => {
        var id = $(el).data('id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('user/edit') }}",
            data: {
                user_id: id
            },
            method: 'post',
            success: function(data) {
                showForm()

                var img = data[0]['user_photo'];

                if (img) {
                    $('#user_photoPreview').attr('src',
                        `{{ Storage::disk('local')->url('public/uploads/user/${img}') }}`);
                }

                $.each(fields, function(i, v) {
                    $('#' + v).val(data[0][v]).change()
                })

                $('#user_password').val('').attr('placeholder',
                    'Kosongkan jika ingin mengubah password');

                if (data[0]['user_active'] == 1) {
                    $('#user_active').prop('checked', true)
                } else {
                    $('#user_active').prop('checked', false)
                }
            }
        })
    }

    onDelete = (el) => {
        var id = $(el).data('id');
        saConfirm({
            message: 'Apakah anda yakin untuk menghapus data?',
            callback: function(res) {
                if (res) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('user/destroy') }}",
                        data: {
                            user_id: id
                        },
                        method: 'post',

                        success: function(res) {
                            saMessage({
                                success: res['success'],
                                title: res['title'],
                                message: res['message']
                            })
                            initTable();

                        }
                    })
                }
            }
        });

    }


    onReset = () => {
        $.each(fields, function(i, v) {
            $('#' + v).val('').change()
        })
        $('#user_active').prop('checked', false);
        removePP()
    }

    readURL = (input) => {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#user_photoPreview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    removePP = () => {
        $('#user_photoPreview').attr('src', '').fadeIn('slow');
        $('#user_photo').val('');
    }

    onCombobox = (el) => {
        loadBlock()
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('role/combobox') }}",
            method: 'post',
            success: function(data) {
                
                $.each(data, (i, v)=>{
                    $('#user_role').append(`
                        <option value="${v['role_id']}">${v['role_nama']}</option>
                    `);
                })
                unblock()
            }
        })

    }
</script>
