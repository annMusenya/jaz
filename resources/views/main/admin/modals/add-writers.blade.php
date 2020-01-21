<div id="add-writers" tabindex="-1" role="dialog" aria-labelledby="add-writers-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="writers-modal" class="modal-title">Hire a writer</h4>

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

        <form id="register-writer"  method="POST" action="/register/writer">

          {{ csrf_field() }}

          <div class="form-group">
            <label class="h6 text-muted">Username</label>
            <input class="form-control" name="username" placeholder="username" required>
            <div class="username-error text-danger mt-2 ml-2 text-sm"></div>
          </div>

          <div class="form-group">
            <label class="h6 text-muted">Email Address</label>
            <input class="form-control" name="email" placeholder="Email" required>
            <div class="email-error text-danger mt-2 ml-2 text-sm"></div>
          </div>

          <div class="form-group">
            <label class="h6 text-muted">Phone</label>
            <input id="phone" class="form-control" name="phone" required>
            <input class="form-control hidden" name="country">
            <div class="phone-error text-danger mt-2 ml-2 text-sm"></div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3 text-md-right">
                <button id="writer-add" class="btn btn-dark" type="submit">Hire Writer</button>
            </div>
          </div>

        </form>

      </div>

    </div>

  </div>

</div>