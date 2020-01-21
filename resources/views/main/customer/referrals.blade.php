@extends ('layouts.main')

@section ('sidebar')

@include ('layouts.sidebar.customer.referrals')

@endsection

@section ('content')

<section>
<div class="row">
    <div class="col-lg-6 mb-4 text-left">
        <h5 class="h5 text-uppercase mb-1 text-muted">Manage Your Credits</h5>
        <small class="text-muted">Referrals earn you points. Redeem points for free paper.</small>
    </div>
    <div class="col-lg-6 text-right">
        
    </div>
</div>
</section>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase">Referral Details</h2>
            </div>
            <div class="card-body">
               <div class="h6 text-muted">Your Referral ID is:</div>
               <div class="h6 text-muted py-3">Your Referral Link is:</div>
               <div class="share mt-3 text-muted h6">Share</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase">Order Points Earned</h2>
            </div>
            <div class="card-body">
               <div class="h6 text-muted">Orders Placed:</div>
               <div class="h6 text-muted py-3">Rate:</div>
               <div class="text-muted h6">Points:</div>
               <div class="btn btn-primary mt-3">Redeem Points</div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h2 class="h6 mb-0 text-uppercase">Referral Statistics</h2>
            </div>
            <div class="card-body">
               <div class="h6 text-muted">Link Clicks:</div>
               <div class="h6 text-muted py-3">Conversion:</div>
               <div class="text-muted h6">Points:</div>
               <div class="btn btn-primary mt-3">Redeem Points</div>
            </div>
        </div>
    </div>
</div>

@endsection