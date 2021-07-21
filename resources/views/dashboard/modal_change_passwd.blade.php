<div id="formChangePasswd" class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Password</h4>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <form method="post" id="edit_password" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                       
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New Password</label>
                                    {{-- <input id="new_password" type="password" class="form-control" name="new_password"
                                    autocomplete="current-password"> --}}
                               
                                <div class="input-group" id="show_hide_password">
                                    <input class="form-control" type="password" name="new_password" id="new_password">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default btn-round btn-sm btn-fab" type="button"><i class="fa fa-eye-slash"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>New Confirm Password</label>
                                    {{-- <input id="new_password_confirmation" type="password" class="form-control"
                                    name="new_password_confirmation" autocomplete="current-password"> --}}
                                    <div class="input-group" id="show_hide_password_new">
                                        <input class="form-control" type="password" name="new_password_confirmation" id="new_password_confirmation">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default btn-round btn-sm btn-fab" type="button"><i class="fa fa-eye-slash"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            

                    </div>

                <input type="hidden" id="hidden_username">
            </div>
            <div class="modal-footer justify-content-between">
                <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Simpan" />
                </form>
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> --}}

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{--   --}}
