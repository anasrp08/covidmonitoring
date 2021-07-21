jQuery(function () {
    $("#refresh").on("click", function (event) {
        $("#tbl_bns_thn_pooling").DataTable().ajax.reload();
    });
    $("#tambah").on("click", function (event) {
        $("#hidden_transaksi").val("tambah");
        $("#modalMasterData").modal();
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function addRp(data) {
        return "Rp. " + data;
    }

    $("#f_master_bonus").on("submit", function (event) {
        event.preventDefault();
        if ($("#hidden_transaksi").val() == "tambah") {
            url = config.routes.sendDataUrlTambah;
            sendData(new FormData(this), url);
        } else {
            url = config.routes.sendDataUrlEdit;
            // var paramData=new FormData(this)
            // paramData.append('id_process',$('#hidden_id').val())
            sendData(new FormData(this), url);
        }
        $("#f_master_bonus").trigger("reset");
        $("#modalMasterData").modal("toggle");
    });
    $("body").on("click", ".edit", function () {
        var data = table.row($(this).closest("tr")).data();
        $("#hidden_transaksi").val("edit");
        $("#hidden_id").val(data.id_process);

        $("#thn_bonus").val(data.tahun).trigger("change");
        $("#nama_bonus").val(data.nama_process).trigger("change");
        $("#budget").val(data.budget_process).trigger("change");
        $("#modalMasterData").modal();
    });
    var id;
    $("body").on("click", ".delete", function () {
        var data = table.row($(this).closest("tr")).data();
        id = data.id_process;
        $("#confirmModal").modal();
    });
    function sendData(paramData, url) {
        $.ajax({
            url: url,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: paramData,
            contentType: false,
            // cache: false,
            processData: false,
            // dataType: "json",
            beforeSend: function () {
                $("#simpan").text("proses menyimpan...");
            },
            success: function (data) {
                if (data.errors) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Perubahan Gagal Disimpan",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
                if (data.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Perubahan Disimpan",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
                $("#simpan").text("Simpan");
                $("#tbl_bns_thn_pooling").DataTable().ajax.reload();
            },
        });
    }

    $("#ok_button").on("click", function () {
        $.ajax({
            url: "/master/destroy/" + id,
            beforeSend: function () {
                $("#ok_button").text("Deleting...");
            },
            success: function (data) {
                if (data.error) {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: data.error,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
                if (data.success) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }

                $("#ok_button").text("OK");
                $("#confirmModal").modal("hide");
                $("#tbl_bns_thn_pooling").DataTable().ajax.reload();
            },
        });
    });

    var idTender;
    var table = $("#tbl_bns_thn_pooling").DataTable({
        processing: true,
        serverSide: true,
        scrollCollapse: true,
        scrollX: true,
        paging: true,
        dom: "lfrtip",

        // buttons: [{
        //     extend: 'excel',
        //     text: 'Export Excel'
        // }],
        columnDefs: [
            {
                className: "text-center",
                targets: [2, 6],
            },
            {
                className: "dt-body-nowrap",
                targets: -1,
            },
        ],
        // select: true,
        language: {
            emptyTable: "Tidak Ada Data",
        },
        search: {
            caseInsensitive: false,
        },
        ajax: {
            url: config.routes.dataTableUrl,
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: function (d) {
                // d.notender = $('#notender').val()
            },
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            {
                data: "nama_process",
                name: "nama_process",
                // render: function (data, type, row) {
                // return 'Performance Level '+data
                // }
            },
            {
                data: "tahun",
                name: "tahun",
                // render: function (data, type, row) {
                // return 'Performance Level '+data
                // }
            },
            {
                data: "status",
                name: "status",
                render: function (data, type, row) {
                    if (data == "1") {
                        return '<h4><span class="badge badge-danger">SUBMIT</span></h4>';
                    } else {
                        return '<h4><span class="badge badge-success">OPEN</span></h4>';
                    }
                },
            },
            {
                data: "budget_process",
                name: "budget_process",
                render: function (data, type, row) {
                    return addRp(numberWithCommas(data));
                },
            },
            {
                data: "budget_unit",
                name: "budget_unit",
                render: function (data, type, row) {
                    return addRp(numberWithCommas(data));
                },
            },

            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});
