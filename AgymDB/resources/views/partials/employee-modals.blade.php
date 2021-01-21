     <!-- Dismiss Employee Modal-->
     <div class="modal fade" id="dismissEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Dismiss employee?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Dismiss" below to confirm dismissal of employee.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <button type="button" class="btn btn-danger"><a href="/admin/employee/{{$employee->id}}/delete" style="color: white">Dismiss</a></button>
             </div>
         </div>
     </div>
 </div>

      <!-- Rehire Employee Modal-->
     <div class="modal fade" id="rehireEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Rehire employee?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Select "Rehire" below to confirm reemployment of employee.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <button type="button" class="btn btn-warning"><a href="/admin/employee/{{$employee->id}}/rehire" style="color: white">Rehire</a></button>
             </div>
         </div>
     </div>
 </div>
