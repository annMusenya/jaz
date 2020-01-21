<div id="upload-files" tabindex="-1" role="dialog" aria-labelledby="message-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static">

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
        
        <form method="post" action="/uploads/{{$order->id}}" enctype="multipart/form-data">
          @csrf 
          <div class="form-group">
                    <label class="form-control-label text-base">What is this file for?</label>
                    <select name="file_description" class="form-control">
                        <option value="Instructions/Guidelines">Instructions/Guidelines</option>
                        <option value="Book/Lecture/Article">Book/Lecture/Article</option>
                        <option value="Sources to be used">Sources to be used</option>
                        <option value="Questions">Questions</option>
                        <option value="Grading Rubric">Grading Rubric</option>
                        <option value="Example Template">Example Template</option>
                        <option value="My Draft">My Draft</option>
                        <option value="Other">Other</option>
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