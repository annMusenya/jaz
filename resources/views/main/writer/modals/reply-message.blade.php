<div id="reply-message-{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="message-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static">

  <div role="document" class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="create-message" class="modal-title">Reply Message</h4>

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

        <form id="create-message" method="post" action="/writer/reply-message/{{$order->id}}">
          @csrf
          <div class="row">
                <div class="form-group col-sm-12 hidden">
                  <label>Username</label>
                  <input type="text" name="order_id" class="hidden" value="{{$order->id}}">
                  <input type="text" name="sender_name" class="form-control text-sm" value="{{$userDetails['name']}}" readonly>
                  <input type="text" name="sender_email" class="form-control" value="{{$userDetails['email']}}">
                  <input type="text" name="sender_id" class="form-control" value="{{$userDetails['id']}}">
                  <input type="text" name="reply_to" class="form-control" value="{{$message->id}}">
                  <input type="text" name="department" class="form-control" value="{{$message->department}}">
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                          <label>Subject</label>
                          <input type="text" name="subject" class="form-control text-sm" value="{{$message->subject}}" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Recipient</label>
                        <select class="form-control" name="recipient">
                              <option value="support" selected>Support</option>
                              <option value="customer">Customer</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="text-message" rows="5" class="form-control text-sm create-message" name="message" onkeypress="textArea(event)" placeholder="Type your message here..."></textarea>
                    </div>
                </div>
                
                <div class="col-sm-12 login-buttons">
                      <div class="col-md-12 mb-3 text-md-right">
                          <input type="submit" value="Send" class="create-message-btn btn btn-dark">
                      </div>
                </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>