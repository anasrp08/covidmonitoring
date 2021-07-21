var dataTables={
    comp:function(id,ajaxParam,columnData){
        return new $(id).DataTable({
            processing: true,
            serverSide: true,
            scrollCollapse: true,
            // scrollX: true,
            scrollX: '100%'  ,          
            paging: true,
            dom: 'lfrtip',

            // buttons: [{
            //     extend: 'excel',
            //     text: 'Export Excel'
            // }],
            columnDefs: 
            [
                // {
                //     className: 'text-center',
                //     targets: [1]
                // },
                // {
                //     className: 'text-right',
                //     targets: [1]
                // },
                    {
                        className: 'text-nowrap',
                        targets: [2]
                    },
                // {
                //     className: 'dt-body-nowrap',
                //     targets: -1
                // }
            ],
            // select: true,
            language: {
                emptyTable: "Tidak Ada Data"
            },
            search: {
                caseInsensitive: false
            },
            ajax: ajaxParam,
            // {
            //     url: "{{ route('faktor.daftar') }}",
            //     type: "POST",
            //     headers: {
            //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
            //     },
            //     data: function (d) {
            //         d.id_process= $('#id_process').val()
            //     }
            // },
            columns: columnData
            // [
                // {
                //     data: 'DT_RowIndex',
                //     name: 'DT_RowIndex',
                //     orderable: false,
                //     searchable: false
                // },
                // {
                //     data: 'nama_process',
                //     name: 'nama_process'
                //     // render: function (data, type, row) {
                //     // return 'Performance Level '+data
                //     // }
                // },
                // {
                //     data: 'nama_sto',
                //     name: 'nama_sto'
                //     // render: function (data, type, row) {
                //     // return 'Performance Level '+data
                //     // }
                // },
                // {
                //     data: 'nama',
                //     name: 'nama',
                    
                // },
                // {
                //     data: 'np',
                //     name: 'np',
                    
                // },
                // {
                //     data: 'nilai',
                //     name: 'nilai',
                    
                // },
                
                // {
                //     data: 'faktor',
                //     name: 'faktor',
                    
                // }, 


            // ],
        }); 
    },
    form:function(id,ajaxParam,columnData){
        return new $(id).DataTable({
            
            scrollCollapse: true,
            searching: false,
            scrollX: true,
            scrollY: "300px",
            paging: false,
            ordering: false,
            dom: 'Bfrtip',
            select: {
                style: 'multi'
            },

            buttons: [

                {
                    text: '<h6 style="color:white"> Hapus Baris</h6>',
                    className: 'btn-info btn-sm',
                    action: function (e, dt, node, config) {

                        var selectedLength = table.rows('.selected').data().length
                        if (selectedLength != 0) {
                            for (i = 0; i < selectedLength; i++) {
                                table.row('.selected').remove().draw(false);
                                // counter= counter - (t.rows('.selected').data().length)
                            }
                            counter = counter - (selectedLength)
                            // table.cell({row:2, column:0}).data(counter);
                        }
                    }
                },
                {
                    text: '<h6 style="color:white"> Simpan Data</h6>',
                    className: 'simpan btn-info btn-sm',
                    action: function (e, dt, node, config) {

                     sendData()
                        // var selectedLength = table.rows('.selected').data().length
                        // if (selectedLength != 0) {
                        //     for (i = 0; i < selectedLength; i++) {
                        //         table.row('.selected').remove().draw(false);
                        //         // counter= counter - (t.rows('.selected').data().length)
                        //     }
                        //     counter = counter - (selectedLength)
                        //     // table.cell({row:2, column:0}).data(counter);
                        // }
                    }
                }

            ],
           
            // select: true,
            language: {
                emptyTable: "Tidak Ada Data"
            }, 
            order: [
                [0, 'asc']
            ],
            // ajax: ajaxParam, 
            // columns: columnData 
        }); 
    }
}
