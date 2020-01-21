<div id="writers" tabindex="-1" role="dialog" aria-labelledby="writers-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="writers-modal" class="modal-title">Select a Writer</h4>

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
        @if($writerCount)
        <form id="writerAssign" method="POST" action="/admin/direct-assign/{{$order->id}}">
          @csrf
          <div class="form-group">
            <label class="h6 text-muted">Available Writers</label>
            <select class="form-control" name="writer">
                @foreach ($writers as $writer)
                  <option value="{{$writer->id}}">{{$writer->name}}</option>
                @endforeach
            </select>
            <div class="mt-2">
                <p class="text-sm text-muted">Select an available writer who will take the order. The assigned writer will be responsible for fulfilling the order.</p>
            </div>
          </div>

          <div class="row login-buttons">

            <div class="col-md-12 mb-3 text-md-right">

              <input class="btn btn-dark" type="submit" value="Assign">

            </div>

          </div>

        </form>

        @else

        <div class="mt-2">
            <div class="text-danger"><i class="file-icon fa fa-warning"></i></div>
            <p class="text-sm text-muted">Select an available writer who will take the order. The assigned writer will be responsible for fulfilling the order.</p>
        </div>

        @endif

      </div>

    </div>

  </div>

</div>