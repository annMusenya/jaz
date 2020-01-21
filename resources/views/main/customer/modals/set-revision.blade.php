<div id="setRevision" tabindex="-1" role="dialog" aria-labelledby="complaint-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="writers-modal" class="modal-title">Request Revision</h4>

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

        <form method="POST" action="/order/revise/{{$order->id}}">

          {{ csrf_field() }}

          <div class="form-group">

            <label class="h6 text-muted">Reason</label>
            
            <select class="form-control" name="reason" required>
                <option value="Additional Instructions" selected>Additional Instructions</option>
                <option value="Wrong Answers">Wrong Answers</option>
                <option value="Grammatical Errors">Grammatical Errors</option>
                <option value="Wrong Formatting">Wrong Formatting</option>
                <option value="Punctuation Errors">Punctuation Errors</option>
                <option value="Improper flow of Ideas">Improper flow of Ideas</option>
                <option value="Weak Arguments">Weak Arguments</option>
                <option value="Low Overall Effect">Low Overall Effect</option>
            </select>

          </div>

          <div class="form-group">

            <label class="h6 text-muted">Explanation</label>
            <textarea rows="5" class="form-control text-sm" name="explanation" placeholder="Explain the why you want this paper revised." required></textarea>

          </div>

          <div class="text-gray-400 text-sm text-center mb-3">By clicking "revise paper", you are setting order to revision. Please provide a reason.</div>

          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input class="btn btn-dark" type="submit" value="Revise Paper">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>