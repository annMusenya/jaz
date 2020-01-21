<div id="rejectOrder" tabindex="-1" role="dialog" aria-labelledby="complaint-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="writers-modal" class="modal-title">Turndown</h4>

        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>

      </div>

      <div class="modal-body">

        <div class="row px-2">

        
          <div class="col-md-12 mb-3 alert alert-danger error-messages">

            <ul>

              @foreach ($errors->all() as $error)

              <li>{{ $error }}</li>

              @endforeach
              
            </ul>
            
          </div>

        </div>

        <form method="POST" action="/order/reject/{{$order->id}}">

          {{ csrf_field() }}

          <div class="form-group">

            <label class="h6 text-muted">Reason</label>
            <select class="form-control" name="reason" required>
                    <option value="deadline" selected>Deadline</option>
                    <option value="complexity">Complexity</option>
                    <option value="workload">Workload</option>
            </select>

          </div>

          <div class="form-group">

            <label class="h6 text-muted">Explanation</label>
            <textarea rows="5" class="form-control text-sm" name="explanation" placeholder="Explain the reason here..." required></textarea>

          </div>

          <div class="text-gray-400 text-sm text-center mb-3">By clicking "reject order", there is no going back. Make sure your reason is justifiable.</div>

          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input class="btn btn-dark" type="submit" value="Reject Order">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>