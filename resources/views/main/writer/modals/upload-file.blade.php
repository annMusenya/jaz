<div id="upload-file" tabindex="-1" role="dialog" aria-labelledby="message-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="create-message" class="modal-title">Admin Upload File</h4>

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
        
        <form method="post" action="/writer/uploads/{{$order->id}}" enctype="multipart/form-data">
          @csrf 
            <div class="form-group">
                <label class="form-control-label text-base">What is this file for?</label>
                <select name="file_description" class="form-control">
                    <option value="Final" selected>Final Paper</option>
                    <option value="Draft">Draft</option>
                    <option value="Sample">Sample Paper</option>
                </select>
            </div>
            <div class="form-group">
            <label class="form-control-label text-base">Upload your Files</label>
                <i class="fa fa-question-circle text-muted mr-0"></i> 
                <input type="file" name="file[]" class="text-sm" accept=".xls,.xlsx,.doc,.txt,.pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"> 
           </div>
           <button class="btn btn-primary" type="submit">Upload</button>
        </form>

      </div>

    </div>

  </div>

</div>