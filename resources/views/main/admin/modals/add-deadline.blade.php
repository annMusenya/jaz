<div id="add-deadline" tabindex="-1" role="dialog" aria-labelledby="deadline-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="deadline-modal" class="modal-title">Add deadline</h4>

        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>

      </div>

      <div class="modal-body">

        @if (!count($academicLevels))

        <div class="row px-2">

          <div class="col-md-12 mb-3 alert alert-warning">

            <h6>Excuse me!</h6>

            <p class="text-sm">Create academic levels first, then you can add deadlines.</p>
            
          </div>

        </div>

        @else

        <form id="add-deadline" method="POST" action="/add-deadline">

          {{ csrf_field() }}

          <div class="form-group">

            <label>Academic Level</label>

            <select id="academic-level" name="name" class="form-control" required>

              @foreach ($academicLevels as $level)

              <option value="{{ $level->name }}">{{ $level->name}}</option>

              @endforeach

            </select>

          </div>

          <div class="form-group hidden">

            <label>Label</label>

            <input name="label" class="form-control" value="45">

          </div>

          <div class="form-group">

            <label>Description</label>

            <input type="text" name="description" class="form-control" placeholder="Brief description" required>

          </div>

          <div class="form-group">

            <label>Hours</label>

            <input type="number" name="hours" step="1" class="form-control" placeholder="How many hours?" required>

          </div>

          <div class="form-group">

            <label>Price Rate in USD</label>

            <input type="number" name="rate" step="0.01" class="form-control" placeholder="Rate in ($)" required>

          </div>

          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input type="submit" value="Save" class="btn btn-dark">

            </div>

          </div>

        </form>


        @endif

      </div>

    </div>

  </div>

</div>