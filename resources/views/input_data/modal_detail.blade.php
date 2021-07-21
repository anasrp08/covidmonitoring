<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="post" id="input_limbah" enctype="multipart/form-data">
                    @csrf
                     @include('input_data.f_detail')


                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                {{-- <button class="btn btn-success" type="button">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
