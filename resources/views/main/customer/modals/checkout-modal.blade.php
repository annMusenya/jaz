<div id="checkout" tabindex="-1" role="dialog" aria-labelledby="checkout-modal" aria-hidden="true" class="modal fade text-left"  data-backdrop="static" data-keyboard="false">
  <div role="document" class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 id="checkout-modal" class="modal-title">Order Summary</h4>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2 text-sm">
                <div class="col-lg-12 ml-2 text-primary h6"><strong><span class="level-summary"></span></strong></div>
                <div class="col-lg-12 ml-2 text-muted">Deadline:<strong><span class="deadline-summary"></span></strong></div>
                <div class="col-lg-12 ml-2 text-muted"><div class="dropdown-divider"></div></div>
                <div class="pages-summary col-lg-8 mt-1 ml-2 text-muted"><span class="pages"></span> X <span class="cost-per-page"></span></div>
                <div class="pages-summary col-lg-2 mt-1  text-blue pages-cost text-right"></div>
                <div class="complex-summary col-lg-8 mt-1 ml-2 text-muted">Complex Assignment</div>
                <div class="complex-summary col-lg-2 mt-1  text-blue complex-cost text-right"></div>
                <div class="ppt-summary col-lg-8 mt-1 ml-2 text-muted"><span class="ppt"></span> X <span class="cost-per-ppt"></span></div>
                <div class="ppt-summary col-lg-2 mt-1 text-blue ppt-cost text-right"></div>
                <div class="charts-summary col-lg-8 mt-1 ml-2 text-muted"><span class="charts"></span> X <span class="cost-per-chart">$10.00</span></div>
                <div class="charts-summary col-lg-2 mt-1  text-blue charts-cost text-right"></div>
                <div class="writer-summary col-lg-8 mt-1 ml-2 text-muted">Top Writer</div>
                <div class="writer-summary col-lg-2 mt-1  text-blue writer-cost text-right"></div>
                <div class="samples-summary col-lg-8 mt-1 ml-2 text-muted samples-price">Order writer samples</div>
                <div class="samples-summary col-lg-2 mt-1  text-blue samples-cost text-right"></div>
                <div class="sources-summary col-lg-8 mt-1 ml-2 text-muted">Copy of sources used</div>
                <div class="sources-summary col-lg-2 mt-1  text-blue sources-cost text-right"></div>
                <div class="progressive-summary col-lg-8 mt-1 ml-2 text-muted">Progressive delivery</div>
                <div class="progressive-summary col-lg-2 mt-1  text-blue progressive-cost text-right"></div>
                <div class="col-lg-12 mt-3"><h6 id="total-price" class="h6 text-muted mb-0 text-right mr-3">Grand Total: <span class="text-primary grandTotal"></span></h6></div>
                <div class="col-lg-12"><div class="dropdown-divider"></div></div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 mb-2"><h6 class="text-muted h6">We accept payments from</h6></div>
                <div class="col-lg-12 text-center mb-4">
                  <img src="{{asset('img/payment.svg')}}" alt="we accept">
                </div>
                <div class="col-lg-12 mb-2">
                    <button  class="btn btn-success" type="submit">Proceed to Payment</button>
                </div>
            </div>
      </div>
  </div>
</div>