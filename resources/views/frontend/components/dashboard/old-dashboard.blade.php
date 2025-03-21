@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')
  <div class="card mb-4">
    <div class="card-widget-separator-wrapper">
      <div class="card-body card-widget-separator">
        <div class="row gy-4 gy-sm-1">
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
              <div>
                <p class="mb-2">In-store Sales</p>
                <h4 class="mb-2">$5,345.43</h4>
                <p class="mb-0">
                  <span class="me-2">5k orders</span
                  ><span class="badge rounded-pill bg-label-success">+5.7%</span>
                </p>
              </div>
              <div class="avatar me-sm-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-home-outline mdi-24px"></i>
                </span>
              </div>
            </div>
            <hr class="d-none d-sm-block d-lg-none me-4" />
          </div>
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
              <div>
                <p class="mb-2">Website Sales</p>
                <h4 class="mb-2">$674,347.12</h4>
                <p class="mb-0">
                  <span class="me-2">21k orders</span
                  ><span class="badge rounded-pill bg-label-success">+12.4%</span>
                </p>
              </div>
              <div class="avatar me-lg-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-laptop mdi-24px"></i>
                </span>
              </div>
            </div>
            <hr class="d-none d-sm-block d-lg-none" />
          </div>
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
              <div>
                <p class="mb-2">Discount</p>
                <h4 class="mb-2">$14,235.12</h4>
                <p class="mb-0">6k orders</p>
              </div>
              <div class="avatar me-sm-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-wallet-giftcard mdi-24px"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="mb-2">Affiliate</p>
                <h4 class="mb-2">$8,345.23</h4>
                <p class="mb-0">
                  <span class="me-2">150 orders</span
                  ><span class="badge rounded-pill bg-label-danger">-3.5%</span>
                </p>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="mdi mdi-currency-usd mdi-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection