<div id="create-message" tabindex="-1" role="dialog" aria-labelledby="message-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static">

  <div role="document" class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="create-message" class="modal-title">Create a message</h4>

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

        <form id="create-message" method="POST" action="/admin/post-message/{{$order->id}}">
          @csrf
          <div class="row">
              <div class="col-lg-6 hidden">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="sender_name" class="form-control text-sm" value="{{$userDetails['name']}}">
                    <input type="text" name="sender_email" class="form-control hidden" value="{{$userDetails['email']}}">
                    <input type="text" name="sender_id" class="form-control hidden" value="{{$userDetails['id']}}">
                </div>
              </div>
              <div class="col-lg-6">
                    <div class="form-group">
                        <label>Addressed To:</label>
                        <select class="form-control text-sm" name="recipient">
                            <option value="all" selected>Customer and Writer</option>
                            <option value="customer">Customer</option>
                            <option value="writer">Writer</option>
                        </select>
                    </div>
              </div>
              <div class="col-lg-6">
                    <div class="form-group">
                    <label>Department</label>
                    <select class="form-control text-sm" name="department">
                        <option value="support" selected>Support Department</option>
                        <option value="quality">Quality Assurance</option>
                    </select>
                    </div>
              </div>
              <div class="form-group col-lg-12">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control text-sm" placeholder="Brief Subject">
              </div>
              <div class="form-group col-lg-12">
                <label>Message</label>
                <textarea rows="5" class="form-control text-sm create-message" name="message" placeholder="Type your message here..."></textarea>
              </div>
              <div class="login-buttons col-md-12">
                <div class="mb-3 text-md-right">
                    <input type="submit" value="Send" class="btn btn-dark">
                </div>
               </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>