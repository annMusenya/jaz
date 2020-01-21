<div id="add-academic" tabindex="-1" role="dialog" aria-labelledby="academic-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="academic-modal" class="modal-title">Add academic level</h4>

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

        <form id="add-academic" method="POST" action="/add-academic">

          {{ csrf_field() }}

          <div class="form-group">

            <label>Academic Level</label>

            <input type="text" name="name" placeholder="Enter the name" class="form-control">

          </div>

          <div class="form-group">

            <label>Reference Label</label>

            <input type="number" name="label" min="1" class="form-control" placeholder="Give number label for reference">

            </div>

          <div class="form-group">

            <label>Description</label>

            <input type="text" name="description" class="form-control" placeholder="Brief description">

          </div>

          <div class="form-group">

            <label>Price Rate in USD</label>

            <input type="number" name="rate" step="0.01" class="form-control" placeholder="Minimum cost in ($)">

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