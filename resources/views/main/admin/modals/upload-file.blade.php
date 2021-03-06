<div id="upload-file" tabindex="-1" role="dialog" aria-labelledby="message-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static">

  <div role="document" class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-header">

        <h4 id="create-message" class="modal-title">Upload File</h4>

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
        
        <form method="post" action="/admin/uploads/{{$order->id}}" enctype="multipart/form-data">
          @csrf 
            <div class="form-group">
                    <label class="form-control-label text-base">Department</label>
                    <select name="uploader" class="form-control">
                        <option value="Support">Support</option>
                    </select>
            </div>
            <div class="form-group">
                <label class="form-control-label text-base">What is this file for?</label>
                <select name="file_description" class="form-control">
                    <option value="Answers">Answers</option>
                    <option value="Guildeline">Guideline</option>
                    <option value="Draft">Paper Draft</option>
                    <option value="Instructions">Instructions</option>
                </select>
            </div>
            <div class="form-group">
            <label class="form-control-label text-base">Upload your Files</label>
                <i class="fa fa-question-circle text-muted mr-0"></i> 
                <input type="file" name="file[]" class="text-sm"> 
           </div>
           <button class="btn btn-primary" type="submit">Upload</button>
        </form>

      </div>

    </div>

  </div>

</div>