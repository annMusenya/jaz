<div id="dispute" tabindex="-1" role="dialog" aria-labelledby="login-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">
  <div role="document" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="login-modal" class="modal-title">Dispute Order</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="#">
      @csrf
        <label class="h6">Reason why?</label>
        <div class="form-group">
            <textarea class="form-control" placeholder="Tell us why you are disputing this order."></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="revision_file">
        </div>
            
        <button class="btn btn-primary">Submit Request</button>
        </form>
    </div>
  </div>
</div>
</div>