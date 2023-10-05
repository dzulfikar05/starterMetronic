<script>
    var table = 'table_role';
    var form = 'form_role';
    var roleSelectId = '';

    var fields = [
        'role_id',
        'role_kode',
        'role_nama',
    ];

    $(() => {
        loadBlock();
        initTable();
    })

    onShowRole = (el) => {
        var id = $(el).data('id');
        roleSelectId = id;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('role/show') }}",
            data: {
                role_id: id
            },
            method: 'post',
            success: function(data) {
                var html = '';
                $.each(data.all_route, (i, v) => {
                    if (v['route_desc'] == 'sub') {
                        html += `<label class="form-check ms-4">
                                    <input id="route-${v['route_id']}" name="${v['route_id']}" class="form-check-input" type="checkbox"
                                        value="1">
                                    <span class="form-check-label">
                                        ${v['route_alias']}
                                    </span>
                                </label>`;

                    } else {
                        html += `<label class="form-check">
                                    <input id="route-${v['route_id']}" name="${v['route_id']}" class="form-check-input" type="checkbox"
                                        value="1">
                                    <span class="form-check-label">
                                        ${v['route_alias']}
                                    </span>
                                </label>`;
                    }
                });

                var dataTree = [];
                $.each(data.all_route, (i, v) => {
                    if (v['route_desc'] != 'sub') {
                        var parentTree = {
                            "text": v['route_alias'],
                            "order": v['route_order'],
                            "children": []
                        };
                        dataTree.push(parentTree);
                    }

                    if (v['route_desc'] == 'sub') {
                        var childernOrder = v['route_order'].split(".");
                        $.each(dataTree, (iT, vT) => {
                            if (vT['order'] == childernOrder[0]) {
                                var childrenTree = {
                                    "text": v['route_alias']
                                };
                                dataTree[iT].children.push(childrenTree);
                            }
                        })
                    }
                });
                // console.log(dataTree);

                // $('#test_tree').jstree({
                //     'core': {
                //         'data': dataTree
                //     },
                //     'checkbox': {
                //         three_state: false,
                //         // cascade: 'up'
                //     },
                //     'plugins': ["wholerow", "themes", "html_data", "checkbox", "sort", "ui"]
                // });

                $('.check-role').html(html);

                $.each(data.role, (i, v) => {
                    $('#route-' + v['user_role_route_id']).prop('checked', true)
                });
            }
        })
        $('.viewRole').modal('show');
    }


    onSaveRole = () => {
        var formData = new FormData($(`[name="form_list_role"]`)[0]);
        formData.append('role_id', roleSelectId);

        // var result = $('#test_tree').jstree('get_selected');
        // console.log(result); return;

        saConfirm({
            message: 'Apakah anda yakin untuk mengubah data?',
            callback: function(res) {
                if (res) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('role/saveRole') }}",
                        method: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            onResetCheck()
                            $('.viewRole').modal('hide');
                            saMessage({
                                success: res['success'],
                                title: res['title'],
                                message: res['message']
                            })
                        }
                    })
                }
            }
        })
    }

    onResetCheck = () => {
        $('input:checkbox').prop('checked', false);
    }

    initTable = () => {
        var table = $('#table_role').DataTable({
            processing: true,
            serverSide: true,
            searchAble: true,
            searching: true,
            paging: true,
            columnDefs: [
                {"className": "dt-center", "targets": "_all"}
            ],
            "bDestroy": true,
            ajax: "{{ route('role/table') }}",
            columns: [{
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
                {
                    data: 'role_kode',
                    name: 'role_kode',
                    render: function(data, type, full, meta) {
                        return `<span>${full.role_kode?full.role_kode:''}</span>`;
                    }
                },
                {
                    data: 'role_nama',
                    name: 'role_nama',
                    render: function(data, type, full, meta) {
                        return `<span>${full.role_nama?full.role_nama:''}</span>`;
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

        var id_role = $('#role_id').val();
        var urlSave = "";

        if (id_role == '' || id_role == null) {
            urlSave += "{{ route('role/store') }}";
        } else {
            urlSave += "{{ route('role/update') }}";
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
                            onReset();
                            initTable();
                            saMessage({
                                success: res['success'],
                                title: res['title'],
                                message: res['message']
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
            url: "{{ route('role/edit') }}",
            data: {
                role_id: id
            },
            method: 'post',
            success: function(data) {
                $.each(fields, function(i, v) {
                    $('#' + v).val(data[0][v]).change()
                })
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
                        url: "{{ route('role/destroy') }}",
                        data: {
                            role_id: id
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
    }
</script>
