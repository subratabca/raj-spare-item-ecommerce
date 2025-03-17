From earlier povided json response update below code to show product name,image,product owner name,if product hasvariant show color,size from Cart Model.product image is stored in public/upload/product/small folder.Give me updated code await axios.get('/user/get-cart-product') with try catch block.


<section class="section-py bg-body first-section-pt">
      <div class="container">
        <div id="wizard-checkout" class="bs-stepper wizard-icons wizard-icons-example mt-2">
          <div class="bs-stepper-content border-top rounded-0">
            <form id="wizard-checkout-form" onSubmit="return false">
              <!-- Cart -->
              <div id="checkout-cart" class="content">
                <div class="row">
                  <!-- Cart left -->
                  <div class="col-xl-8 mb-3 mb-xl-0">
                    <!-- Offer alert -->
                    <div class="alert alert-success mb-4" role="alert">
                      <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                          <i class="mdi mdi-check-circle-outline mdi-24px"></i>
                        </div>
                        <div class="flex-grow-1">
                          <div class="fw-medium">Available Offers</div>
                          <ul class="list-unstyled mb-0">
                            <li>- 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</li>
                            <li>- 25% Cashback Voucher of up to $60 on first ever PayPal transaction. TCA</li>
                          </ul>
                        </div>
                      </div>
                      <button
                        type="button"
                        class="btn-close btn-pinned"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
                    </div>

                    <!-- Shopping bag -->
                    <h5>My Shopping Bag (2 Items)</h5>
                    <ul class="list-group mb-3">
                      <li class="list-group-item p-4">
                        <div class="d-flex gap-3">
                          <div class="flex-shrink-0">
                            <img src="../../assets/img/products/1.png" alt="google home" class="w-px-100" />
                          </div>
                          <div class="flex-grow-1">
                            <div class="row">
                              <div class="col-md-8">
                                <h6 class="me-3">
                                  <a href="javascript:void(0)" class="text-heading">Google - Google Home - White</a>
                                </h6>
                                <div class="mb-1 d-flex flex-wrap">
                                  <span class="me-1">Sold by:</span>
                                  <a href="javascript:void(0)" class="me-1">Google</a>
                                  <span class="badge bg-label-success rounded-pill">In Stock</span>
                                </div>
                                <div class="read-only-ratings mb-2 px-0" data-rateyo-read-only="true"></div>
                                <input
                                  type="number"
                                  class="form-control form-control-sm w-px-100 mt-4"
                                  value="1"
                                  min="1"
                                  max="5" />
                              </div>
                              <div class="col-md-4">
                                <div class="text-md-end">
                                  <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                  <div class="my-2 mt-md-4 mb-md-5">
                                    <span class="text-primary">$299/</span><span class="text-body">$359</span>
                                  </div>
                                  <button type="button" class="btn btn-sm btn-outline-primary mt-3">
                                    Move to wishlist
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item p-4">
                        <div class="d-flex gap-3">
                          <div class="flex-shrink-0">
                            <img src="../../assets/img/products/2.png" alt="google home" class="w-px-100" />
                          </div>
                          <div class="flex-grow-1">
                            <div class="row">
                              <div class="col-md-8">
                                <h6 class="me-3">
                                  <a href="javascript:void(0)" class="text-heading">Apple iPhone 11 (64GB, Black)</a>
                                </h6>
                                <div class="mb-1 d-flex flex-wrap">
                                  <span class="me-1">Sold by:</span>
                                  <a href="javascript:void(0)" class="me-1">Apple</a>
                                  <span class="badge bg-label-success rounded-pill">In Stock</span>
                                </div>
                                <div class="read-only-ratings mb-2 px-0" data-rateyo-read-only="true"></div>
                                <input
                                  type="number"
                                  class="form-control form-control-sm w-px-100 mt-4"
                                  value="1"
                                  min="1"
                                  max="5" />
                              </div>
                              <div class="col-md-4">
                                <div class="text-md-end">
                                  <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                  <div class="my-2 mt-md-4 mb-md-5">
                                    <span class="text-primary">$899/</span><span class="text-body">$999</span>
                                  </div>
                                  <button type="button" class="btn btn-sm btn-outline-primary mt-3">
                                    Move to wishlist
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>

                    <!-- Wishlist -->
                    <div class="list-group">
                      <a href="javascript:void(0)" class="list-group-item d-flex justify-content-between">
                        <span class="text-primary">Add more products from wishlist</span>
                        <i class="mdi mdi-chevron-right lh-sm scaleX-n1-rtl"></i>
                      </a>
                    </div>
                  </div>

                  <!-- Cart right -->
                  <div class="col-xl-4">
                    <div class="border rounded p-3 mb-3">
                      <!-- Offer -->
                      <h6>Offer</h6>
                      <div class="row g-3 mb-3">
                        <div class="col-sm-8 col-xxl-8 col-xl-12">
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Enter Promo Code"
                            aria-label="Enter Promo Code" />
                        </div>
                        <div class="col-4 col-xxl-4 col-xl-12">
                          <div class="d-grid">
                            <button type="button" class="btn btn-outline-primary">Apply</button>
                          </div>
                        </div>
                      </div>

                      <!-- Gift wrap -->
                      <div class="bg-lighter rounded p-3">
                        <h6>Buying gift for a loved one?</h6>
                        <p>Gift wrap and personalized message on card, Only for $2.</p>
                        <a href="javascript:void(0)" class="fw-medium">Add a gift wrap</a>
                      </div>
                      <hr class="mx-n3" />

                      <!-- Price Details -->
                      <h6 class="mb-4">Price Details</h6>
                      <dl class="row mb-0">
                        <dt class="col-6 fw-normal text-heading">Bag Total</dt>
                        <dd class="col-6 text-end">$1198.00</dd>

                        <dt class="col-6 fw-normal text-heading">Coupon Discount</dt>
                        <dd class="col-6 text-primary text-end fw-medium">Apply Coupon</dd>

                        <dt class="col-6 fw-normal text-heading">Order Total</dt>
                        <dd class="col-6 text-end">$1198.00</dd>

                        <dt class="col-6 fw-normal text-heading">Delivery Charges</dt>
                        <dd class="col-6 text-end">
                          <s class="text-muted">$5.00</s> <span class="badge bg-label-success rounded-pill">Free</span>
                        </dd>
                      </dl>
                      <hr class="mx-n3 my-3" />
                      <dl class="row mb-0 h6">
                        <dt class="col-6 mb-0">Total</dt>
                        <dd class="col-6 text-end mb-0">$1198.00</dd>
                      </dl>
                    </div>
                    <div class="d-grid">
                      <button class="btn btn-primary btn-next">Place Order</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</section>