<div id="add-subject" tabindex="-1" role="dialog" aria-labelledby="subject-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="add-subject" class="modal-title">Add new discipline</h4>

        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>

      </div>

      <div class="modal-body">

        <form id="add-subject" method="POST" action="/add-subject">

          {{ csrf_field() }}

          <div class="form-group">

            <label>Discipline Name</label>

            <input type="text" name="name" placeholder="Enter the name" class="form-control">

          </div>

          <div class="form-group">

            <label>Description</label>

            <input type="text" name="description" class="form-control" placeholder="Brief description">

          </div>

          <div class="form-group">

            <label>Price Rate in USD</label>

            <input type="number" name="amount" step="0.01" min="0.00" class="form-control" placeholder="Minimum cost in ($)">

          </div>

          <div class="form-group">

            <label>Category</label>

            <select name="category" class="form-control">
              <option selected>Most Popular</option>
              <option>Humanities</option>
              <option>Social Sciences</option>
              <option>Business and Management</option>
              <option>Natural Sciences</option>
              <option>Formal Sciences</option>
              <option>Applied Sciences</option>
              <option>Other</option>
            </select>

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