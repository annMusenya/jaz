<div class="card">
  <div class="card-header">
    <h5 class="h6 text-uppercase mb-0 text-gray-500">Step 3:Additionals</h5>
  </div>
  <div class="card-body">
  
	<div class="form-group">
    <label class="form-control-label">Powerpoint Slides</label>
    <i class="fa fa-question-circle text-muted"></i>
    <div class="form-group">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <button id="minusPPT" type="button" class="btn btn-dark">-</button>
        </div>
        <input type="text" name="powerpoint_slides" value="0" class="form-control text-md-center">
        <div class="input-group-append">
          <button id="addPPT" type="button" class="btn btn-dark">+</button>
        </div>
      </div>
    </div>
   </div>
   
    <div class="form-group">
      <label class="form-control-label">Charts</label>
      <i class="fa fa-question-circle text-muted"></i>
      <div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <button id="minusCharts" type="button" class="btn btn-dark">-</button> 
          </div>
          <input type="text" name="charts" value="0" class="form-control text-md-center">
          <div class="input-group-append">
            <button id="addCharts" type="button" class="btn btn-dark">+</button>
          </div>
        </div>
      </div> 
    </div>
	
	<div class="form-group">
    <label class="form-control-label">Sources</label>
    <i class="fa fa-question-circle text-muted"></i>
    <div class="input-group">
      <div class="input-group-prepend">
        <button id="minusSources" type="button" class="btn btn-dark">-</button>
      </div>
      <input type="text" name="references" value="0" class="form-control text-md-center">
      <div class="input-group-append">
        <button id="addSources" type="button" class="btn btn-dark">+</button>
      </div>
    </div>
  </div>
  
	<div class="form-group">
    <label class="form-control-label">Writer Category</label>
    <i class="fa fa-question-circle text-muted"></i>
    <div class="form-group writer-spacing">
        <div class="custom-control custom-radio custom-control-inline">
          <input id="customRadioInline3" type="radio" name="writer" value="standard" class="custom-control-input" checked>
          <label for="customRadioInline3" class="custom-control-label text-sm">Standard</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input id="customRadioInline4" type="radio" name="writer" value="top-writer" class="custom-control-input">
          <label for="customRadioInline4" class="custom-control-label text-sm">Top Writer(+25%)</label>
        </div>
      </div>
    </div>

      <label class="form-control-label text-base">Additional Services</label>
      <i class="fa fa-question-circle text-muted mr-0"></i>
    <div class="form-group ml-3">
        <div class="custom-control custom-checkbox row">
            <input id="writer-samples" name="writer_samples" type="checkbox" class="custom-control-input col-sm-1" value="samples">
            <label for="writer-samples" class="custom-control-label text-muted col-sm-8">Get 3 writer samples.</label>
            <span class="text-primary col-sm-2"><strong>$5.00</strong></span>
        </div>
    </div>
    <div class="form-group ml-3">
        <div class="custom-control custom-checkbox row">
            <input id="writer-sources" name="writer_sources" type="checkbox" class="custom-control-input col-sm-1" value="samples">
            <label for="writer-sources" class="custom-control-label text-muted col-sm-8">Copy of sources.</label>
            <span class="text-primary col-sm-2"><strong>$10.00</strong></span>
        </div>
    </div>
    <div class="form-group ml-3">
        <div class="custom-control custom-checkbox row">
            <input id="progressive-delivery" name="progressive_delivery" type="checkbox" class="custom-control-input col-sm-1" value="samples" disabled>
            <label id="written-text" for="progressive-delivery" class="custom-control-label text-muted col-sm-8 text-gray-300">Progressive Delivery.</label>
            <span id="costValue" class="col-sm-2 text-gray-300"><strong>+10%</strong></span>
        </div>
    </div>
  </div>
</div>