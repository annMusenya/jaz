<div id="add-citation" tabindex="-1" role="dialog" aria-labelledby="citation-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="citation-modal" class="modal-title">Add citation style</h4>

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


        <form id="add-citation" method="POST" action="/add-citation">

          {{ csrf_field() }}

          <div class="form-group">

            <label>Name</label>

            <input type="text" name="name" class="form-control" placeholder="Enter the name of style" required>

          </div>

          <div class="form-group">

            <label>Description</label>

            <input type="text" name="description" class="form-control" placeholder="Brief description" required>

          </div>
          
          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input type="submit" value="Save" class="btn btn-dark">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>