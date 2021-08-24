<div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <form action = "{{ route('changePassword') }}"  method="post">
        @csrf
        {{-- @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Change Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                    <label for="old-pass" class="col-sm-4 col-form-label" style="color: black">Current Password</label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control @error('current_pass') is-invalid @enderror" id="oldpassword" name="current_pass" placeholder="Current Pass" required>
                        @error('current_pass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="new-pass" class="col-sm-4 col-form-label" style="color: black">New Password</label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Pass" required>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-pass" class="col-sm-4 col-form-label" style="color: black">Confirm Password</label>
                        <div class="col-sm-7">
                        <input type="password" class="form-control" id="confirm-pass" name="confirm-pass" placeholder="Confirm Pass" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
</div>
