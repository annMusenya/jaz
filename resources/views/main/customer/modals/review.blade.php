<div id="review" tabindex="-1" role="dialog" aria-labelledby="complaint-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="writers-modal" class="modal-title">Your Feedback</h4>

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

        <form method="POST" action="/customer/review/{{$order->id}}">

          {{ csrf_field() }}
          <div class="form-group">
            <label class="form-control-label h6 text-muted">Rating</label>
            
            <div class="form-group writer-spacing">
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="one" type="radio" name="rating" value="1" class="custom-control-input">
                  <label for="one" class="custom-control-label text-sm">1</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="two" type="radio" name="rating" value="2" class="custom-control-input">
                  <label for="two" class="custom-control-label text-sm">2</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="three" type="radio" name="rating" value="3" class="custom-control-input">
                  <label for="three" class="custom-control-label text-sm">3</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="four" type="radio" name="rating" value="4" class="custom-control-input">
                  <label for="four" class="custom-control-label text-sm">4</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input id="five" type="radio" name="rating" value="5" class="custom-control-input">
                  <label for="five" class="custom-control-label text-sm">5</label>
                </div>
              </div>

            </div>

          <div class="form-group">

            <input name="writer_id" value="{{$order->writer_id}}" class="form-control hidden">

          </div>

          <div class="form-group">

            <label class="h6 text-muted">Help us improve</label>
            <textarea rows="5" class="form-control text-sm" name="feedback" placeholder="Tell us why you gave us such a rating..." required></textarea>

          </div>

          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input class="btn btn-dark" type="submit" value="Submit Review">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>