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

        <form id="c-post-msg" class="row" method="POST" action="/post-message/{{$order->id}}">
            @csrf
            <div class="form-group hidden">
                <label>Username</label>
                <input type="text" name="order_id" class="hidden" value="{{$order->id}}">
                <input type="text" name="sender_name" class="form-control text-sm" value="{{$userDetails['name']}}" readonly>
                <input type="text" name="sender_email" class="form-control" value="{{$userDetails['email']}}">
                <input type="text" name="sender_id" class="form-control" value="{{$userDetails['id']}}">
            </div>
            <div class="form-group col-md-6">
              <label>Addressed To:</label>
              <select class="form-control" name="recipient">
                  @if($order->payment_status == 0)
                      <option value="support">Support Team</option>
                  @else
                      <option value="writer" selected>Writer</option>
                      <option value="support">Support Team</option>
                  @endif
              </select>
            </div>
            <div class="form-group col-md-6">
                  <label>Subject</label>
                  <input type="text" name="subject" class="form-control text-sm" placeholder="Subject">
                  <div class="subject-error text-danger mt-2 ml-2 text-sm hidden"></div>
            </div>
            <div class="form-group col-md-12">
              <label>Message</label>
              <textarea rows="5" class="form-control text-sm create-message" name="message" placeholder="Type your message here..."></textarea>
              <div class="message-error text-danger mt-2 ml-2 text-sm hidden"></div>
            </div>
            <div class="col-md-12 mb-3 text-md-right">
              <button id="customer-message-btn" type="submit" class="btn btn-dark">Send</button>
            </div>
        </form>

      </div>

    </div>

  </div>

</div>