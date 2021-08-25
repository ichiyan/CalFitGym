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
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required
                            placeholder="Enter current password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-pass" class="col-sm-4 col-form-label" style="color: black">New Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required
                            placeholder="Enter the new password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-pass" class="col-sm-4 col-form-label" style="color: black">Confirm Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required placeholder="Enter same password">
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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

<script type="text/javascript">
    if (count($errors) > 0)
        $('#changePassModal').modal('show');
    </script>
