<div class="card">

 <div class="card-header">

  <h5 class="h6 text-uppercase mb-0 text-gray-500">Step 2:Instructions</h5>

</div>

<div class="card-body">

	<div class="form-group">

    <label class="form-control-label text-base">Deadline</label>

    <i class="fa fa-question-circle text-muted mr-0"></i> 

    <select name="deadline" class="form-control">
          <option value="336" selected>14 days</option>
          <option value="168">7 days</option>
          <option value="120">5 days</option>
          <option value="72">3 days</option>
          <option value="48">2 days</option>
          <option value="24">24 hours</option>
          <option value="8">8 hours</option>
          <option value="4">4 hours</option>
    </select>

    <input name="deadline_period" class="hidden">

    <div class="mt-2 mb-1"><small>Deadline <strong class="text-muted deadline-period"></strong></small></div>

  </div>

	 <div class="form-group">
      <label class="form-control-label text-base">Additional Materials</label>
      <i class="fa fa-question-circle text-muted mr-0"></i> 
      <input id="filer_input" type="file" name="file[]" multiple>
    </div>

  <div class="form-group">

    <label class="form-control-label">Paper Format</label>

    <i class="fa fa-question-circle text-muted"></i>

    <select name="citation" class="form-control">
      @foreach ($citations as $citation)
          <option value="{{$citation -> name}}">{{ $citation->name }}</option>
      @endforeach
    </select>

  </div>
  
  <div class="form-group">

      <label class="form-control-label">Word Spacing</label>

      <i class="fa fa-question-circle text-muted"></i>

      <div class="form-group writer-spacing">

        <div class="custom-control custom-radio custom-control-inline">

          <input id="customRadioInline1" type="radio" value="double" name="word_spacing" class="custom-control-input" checked>

          <label for="customRadioInline1" class="custom-control-label text-sm">Double Space</label>

        </div>

        <div class="custom-control custom-radio custom-control-inline">

          <input id="customRadioInline2" type="radio" value="single" name="word_spacing" class="custom-control-input">

          <label for="customRadioInline2" class="custom-control-label text-sm">Single Space</label>

        </div>

      </div>

    </div>
  
  <div class="form-group">
	  <div class="row">
			<div class="col-sm-8"><label class="form-control-label">Pages</label></div>
			<div class="col-sm-4"><small class="number-of-words text-muted text-right"></small></div>
	  </div>
      <div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <button id="minusPages" type="button" class="btn btn-dark">-</button>
          </div>
          <input type="text" name="pages" value="1" class="form-control text-md-center">
          <div class="input-group-append">
            <button id="addPages" type="button" class="btn btn-dark">+</button>
          </div>
        </div>
      </div>
      
    </div>
 
 
	
</div>
</div>
