<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="edit_karyawan" enctype="multipart/form-data">
                    @csrf
                     @include('input_data.f_edit')


               
            </div>
            <div class="modal-footer">
               
                <button class="btn btn-success" type="submit" id='simpan'>Save changes</button>
            </form>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
