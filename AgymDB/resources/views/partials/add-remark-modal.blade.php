<div class="modal fade" id="addRemarkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <form action = "{{ route('addRemark') }}"  method="post">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Add Remark</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <label for="old-pass" class="col-sm-4 col-form-label" style="color: black">Remark</label>
                        <div class="col-sm-7">
                            <textarea type="text" name="content" class="form-control" required
                            placeholder="add remark">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new-pass" class="col-sm-4 col-form-label" style="color: black">Show to Trainee</label>
                        <div class="col-sm-7">
                            <select name="showToCustomer">
                                <option value=1>YES</option>
                                <option value=0>NO</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="customer_id" value="">
                <button type="submit" class="btn btn-primary">Add Remark</button>
            </div>
        </div>
    </form>
</div>
</div>


