<div id="add-document" tabindex="-1" role="dialog" aria-labelledby="document-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="add-document" class="modal-title">Add document type</h4>

        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>

      </div>

      <div class="modal-body">

        <form id="add-document" method="POST" action="/add-document">

          {{ csrf_field() }}

          <div class="form-group">

            <label>Document Name</label>

            <input type="text" name="name" placeholder="Enter the name" class="form-control">

          </div>

          <div class="form-group">

            <label>Description</label>

            <input type="text" name="description" class="form-control" placeholder="Brief description">

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