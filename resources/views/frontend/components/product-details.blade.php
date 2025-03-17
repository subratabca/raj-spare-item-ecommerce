<section class="section-py bg-body first-section-pt">
  <div class="container"> 
    <form id="save-form"> 
      <div class="card g-3 mt-5">
        <div class="card-body row g-3">
          <hr>
          <div class="col-lg-7">
            <div class="card academy-content shadow-none border">
              <div class="p-2">
                <div class="cursor-pointer">
                  <div class="row">
                    <div class="col-12">
                      <div id="gallery-wrapper">
                        <!-- Main gallery -->
                        <div class="gallery-main">
                          <img id="mainImage" src="/upload/no_image.jpg" alt="Main Image" style="width: 100%; height: auto;" />
                        </div>
                        <div class="gallery-thumbs mt-3" id="galleryThumbImages" style="display: flex; gap: 10px;">

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <p class='p-2' id="product-description111"></p>
            </div>
            <!-- <button onclick="shareToFacebook(event)" class="btn btn-primary mt-3 btn-next">Share with Facebook</button> -->
            <button onclick="shareFacebookURL(event)" class="btn btn-success mt-3 btn-next">Share Facebook URL</button>
           <!--  <button onclick="shareInstagramURL(event)" class="btn btn-success mt-3 btn-next">Share Instagram URL</button> -->
            <button onclick="openEmailModal(event)" class="btn btn-primary mt-3 btn-next">Share With Email</button>
          </div>
          <div class="col-lg-5">
            <div class="border rounded p-3 mb-3">
              <div class="bg-lighter rounded p-3">
                <input type="hidden" id="hasVariants" name="has_variants" value="0">
                <h6>Item Name: <span id="product-name"></span></h6><hr class="my-4" />
                <h6>Category Name: <span id="category-name"></span></h6><hr class="my-4" />
                <h6>Description:</h6> <span id="product-description"></span><hr class="my-4" />
                <h6 class="d-inline">Price:</h6><span id="product-price" class="ms-2"></span><hr class="my-4" />
                <h6>Available Stock: <span id="current-stock" class="text-danger"></span></h6><hr class="my-4" />

                <div id="food-item-fields" style="display: none;">
                  <h6>Expire Date: <span id="expire-date"></span></h6><hr class="my-4" />
                  <h6>Collection Location: <span id="address"></span></h6><hr class="my-4" />
                  <h6>Collection Date: <span id="collection-date"></span></h6><hr class="my-4" />
                  <h6>Collection Time: <span id="end-collection-time"></span></h6><hr class="my-4" />
                </div>


              <!-- Variant Selection (Initially Hidden) -->
              <div id="variant-section" style="display: none;">
                <div class="row">
                    <div class="col-md-6" id="colorContainer">
                        <div class="form-floating form-floating-outline">
                            <select id="colorSelect" class="form-select w-100" aria-label="Select Color">
                            </select>
                            <label for="colorSelect">Select Color<span class="text-danger">*</span></label>
                        </div>
                        <span class="error-message text-danger" id="color-error"></span>
                    </div>

                    <div class="col-md-6" id="sizeContainer">
                        <div class="form-floating form-floating-outline">
                            <select id="sizeSelect" class="form-select w-100" aria-label="Select Size">
                            </select>
                            <label for="sizeSelect">Select Size<span class="text-danger">*</span></label>
                        </div>
                        <span class="error-message text-danger" id="size-error"></span>
                    </div>
                </div><hr class="my-4" />
              </div>
                <h6>Select Qty: 
                  <input type="number" id="qty" class="form-control" value="1" min="1">
                  <span class="error-message text-danger" id="qty-error"></span>
                </h6><hr class="my-4" />
                <h6>Provided By: <span id="client-name"></span></h6><hr class="my-4" />
              </div>
            </div>

            <div class="d-grid">
              <button onclick="Save(event)" class="btn btn-primary btn-next item-request-btn">Request Item</button>
              <button type="button" id="add-to-cart-btn" style="display: none;" onclick="addToCart()" class="btn btn-primary mt-2">
            <span class="mdi mdi-cart-outline"></span> ADD TO CART
        </button>

            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="container-xxl flex-grow-1 container-p-y" style="display:none">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <h5 class="card-header">Item Collection Map</h5>
          <div class="card-body">
            <div class="leaflet-map" id="userLocation"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
document.addEventListener("DOMContentLoaded", updateCartCount);
let url = window.location.pathname;
let segments = url.split('/');
let id = segments[segments.length - 1];

function openEmailModal(event) {
  event.preventDefault();  
  document.getElementById('itemID').value = id;
  let emailModal = new bootstrap.Modal(document.getElementById('email-modal'));
  emailModal.show();
}

async function ProductDetailsInfo() {
  if (isTokenValid()) {
    await getProfile();
  }

  showLoader();
  try {
    let res = await axios.get("/product-details-info/" + id);
    let data = res.data.data;
    console.log('-----------',data);
    let mainImageElement = document.getElementById('mainImage');
    let mainImage = '{{ asset("/upload/product/large/") }}/' + data.image;
    mainImageElement.src = mainImage;

    let galleryThumbs = document.getElementById('galleryThumbImages');
    let thumbHTML = '';

    thumbHTML += `<img src="${mainImage}" alt="Thumb Image" class="thumb-img" style="cursor: pointer; width: 120px; height: auto;" onclick="updateMainImage('${mainImage}')">`;

    if (data.product_images && data.product_images.length > 0) {
      data.product_images.forEach(productImage => {
        let thumbImage = '{{ asset("/upload/product/multiple/") }}/' + productImage.image;
        thumbHTML += `<img src="${thumbImage}" alt="Thumb Image" class="thumb-img" style="cursor: pointer; width: 120px; height: auto;" onclick="updateMainImage('${thumbImage}')">`;
      });
    }

    galleryThumbs.innerHTML = thumbHTML;

    let firstName = data['client']['firstName'];
    let lastName = data['client']['lastName'];
    let fullName = lastName ? `${firstName} ${lastName}` : firstName;

    const priceElement = document.getElementById('product-price');
    if (data.is_free === 1) {
        priceElement.innerHTML = '<span class="text-success fw-semibold">Free</span>';
    } else {
        let priceHTML = `<span class="text-primary">£${parseFloat(data.price).toFixed(2)}</span>`;
        if (data.has_discount_price === 1) {
            priceHTML = `
                <span class="text-muted text-decoration-line-through me-2">£${parseFloat(data.price).toFixed(2)}</span>
                <span class="text-danger fw-bold">£${parseFloat(data.discount_price).toFixed(2)}</span>
            `;
        }
        priceElement.innerHTML = priceHTML;
    }

    if (data['category']['name'] === 'Food') {
      document.getElementById('food-item-fields').style.display = 'block';
    }

    if (data['category']['name'] !== 'Food' && data.variants && data.variants.length > 0) {
        document.getElementById('variant-section').style.display = 'block';
        populateVariants(data.variants);
        //document.getElementById('hasVariants').value = "1"; // Set value to 1 if variants exist
    } 

    document.getElementById('hasVariants').value = data['has_variants'];
    document.getElementById('product-name').innerText = data['name'];
    document.getElementById('category-name').innerText = data['category']['name'];
    document.getElementById('current-stock').innerHTML = data['current_stock'];
    document.getElementById('product-description').innerHTML = data['description'];
    document.getElementById('expire-date').innerText = data['expire_date'];
    document.getElementById('address').innerText = data['address1'];
    document.getElementById('collection-date').innerText = data['collection_date'];
    document.getElementById('end-collection-time').innerText = data['end_collection_time'];
    document.getElementById('client-name').innerText = fullName;

  } catch (error) {
    console.error(error);
  } finally{
     hideLoader();
  }
}

function populateVariants(variants) {
  const colorSelect = document.getElementById('colorSelect');
  const sizeSelect = document.getElementById('sizeSelect');
  let colorSizeMap = {};
  let variantMap = {}; // Store variant quantities
  let productTotalStock = document.getElementById('current-stock').innerHTML; // Store original total stock

  variants.forEach(variant => {
    // Create color-size mapping
    if (!colorSizeMap[variant.color]) {
      colorSizeMap[variant.color] = [];
    }
    colorSizeMap[variant.color].push({
      id: variant.id,
      size: variant.size,
      qty: variant.current_stock // Make sure this matches your variant stock field
    });
    
    // Store variant quantities in a map
    variantMap[variant.id] = variant.current_stock;
  });

  // Clear and populate color options
  colorSelect.innerHTML = '<option value="">Select Color</option>';
  Object.keys(colorSizeMap).forEach(color => {
    colorSelect.add(new Option(color, color));
  });

  // Handle color selection change
  colorSelect.addEventListener('change', function() {
    const selectedColor = this.value;
    sizeSelect.innerHTML = '<option value="">Select Size</option>';
    document.getElementById('current-stock').innerHTML = productTotalStock; // Reset to total when color changes
    
    if (selectedColor && colorSizeMap[selectedColor]) {
      colorSizeMap[selectedColor].forEach(sizeInfo => {
        const option = new Option(`${sizeInfo.size}`, sizeInfo.id);
        sizeSelect.add(option);
      });
    }
    
    checkAddToCartVisibility();
    validateQty();
  });

  // Handle size selection change
  sizeSelect.addEventListener('change', function() {
    const variantId = this.value;
    if (variantId && variantMap[variantId]) {
        document.getElementById('current-stock').textContent = variantMap[variantId];
    } else {
        // Reset to product stock when no variant selected
        document.getElementById('current-stock').textContent = productTotalStock;
    }
    validateQty(); // Trigger validation on size change
});

  // Add quantity input validation
  document.getElementById('qty').addEventListener('input', validateQty);
}

function validateQty() {
    const qtyInput = document.getElementById('qty');
    const qtyError = document.getElementById('qty-error');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    
    // Get current available stock from the displayed value
    const availableStock = parseInt(document.getElementById('current-stock').textContent) || 0;
    const enteredQty = parseInt(qtyInput.value) || 0;

    if (enteredQty < 1) {
        qtyError.textContent = 'Quantity must be at least 1';
        addToCartBtn.disabled = true;
    } else if (enteredQty > availableStock) {
        qtyError.textContent = `Quantity must be less than or equal to ${availableStock}`;
        addToCartBtn.disabled = true;
    } else {
        qtyError.textContent = '';
        addToCartBtn.disabled = false;
    }
}

// Add event listeners for input changes
document.getElementById('qty').addEventListener('input', validateQty);
document.getElementById('sizeSelect').addEventListener('change', validateQty);
document.getElementById('colorSelect').addEventListener('change', validateQty);


async function addToCart() {
    validateQty();
    if (document.getElementById('add-to-cart-btn').disabled) {
        return;
    }

    const qty = document.getElementById('qty').value;
    const hasVariants = document.getElementById('hasVariants').value;
    let variantId = null;

    if (hasVariants === '1') {
        variantId = document.getElementById('sizeSelect').value;
        if (!variantId) {
            errorToast("Please select a variant.");
            return;
        }
    }

    const formData = new FormData();
    formData.append('product_id', id);
    formData.append('quantity', qty);
    if (variantId) {
        formData.append('variant_id', variantId);
    }

    try {
        const res = await axios.post('/user/cart/add', formData);
        if (res.status === 200) {
            successToast(res.data.message || 'Item added to cart');
            updateCartCount();
        } else {
            errorToast(res.data.message || 'Failed to add to cart');
        }
    } catch (error) {
        if (error.response) {
            errorToast(error.response.data.message || 'Error adding to cart');
        } else {
            errorToast('Network error. Please try again.');
        }
    }
}

function checkAddToCartVisibility() {
  const colorSelected = document.getElementById('colorSelect').value !== '';
  const sizeSelected = document.getElementById('sizeSelect').value !== '';
  document.getElementById('add-to-cart-btn').style.display = 
    (colorSelected && sizeSelected) ? 'block' : 'none';
}

function updateMainImage(imageSrc) {
  let mainImageElement = document.getElementById('mainImage');
  mainImageElement.src = imageSrc;
}

async function Save(event) {
  event.preventDefault();
  let formData = new FormData();
  formData.append('id', id);

  const config = {
    headers: {
      'content-type': 'multipart/form-data',
    },
  };

  try {
    let res = await axios.post("/user/store/product-request", formData, config);
    if (res.status === 201) {
      successToast(res.data.message || 'Request success');
      window.location.href = '/';
    } else {
      errorToast(res.data.message || "Request failed");
    }
  }  catch (error) {
    if (error.response) {
      if (error.response.status === 401) {
        window.location.href = '/user/login';
      } else if (error.response.status === 422) {
        let errorMessages = error.response.data.errors;
        for (let field in errorMessages) {
          if (errorMessages.hasOwnProperty(field)) {
            document.getElementById(`${field}-error`).innerText = errorMessages[field][0];
          }
        }
      } else if (error.response.status === 403 ) {
        errorToast(error.response.data.message || "You cannot request until the complaint is resolved.");
      } else if (error.response.status === 404) {
        errorToast(error.response.data.message || "Resource not found.");
      } else if (error.response.status === 500) {
        errorToast(error.response.data.error || "An internal server error occurred.");
      } else if (error.response.status === 400) {
        errorToast(error.response.data.message || "Bad request.");
        window.location.href = '/';
      } else {
        errorToast("Request failed!");
      }
    } else {
      errorToast("Request failed!");
    }
    console.error(error);
  }
}

async function getProfile() {
  showLoader();
  try {
    let res = await axios.get("/user/profile/info");

    if (res.status === 200 && res.data.status === 'success') {
      let customerData = res.data.data;
      const customerStatus = customerData.status;
      if (customerStatus === 0) {
        let cardBody = document.querySelector('.card-body.row.g-3');
        let dGridContainer = document.querySelector('.d-grid');
        let requestButton = document.querySelector('.item-request-btn');

        if (cardBody) {
          let message = `
          <h5 class="text-danger d-flex justify-content-center mt-5">
          <span class="text-danger">
          To request an item, you must submit the necessary documents.
          </span> 
          <a href="/user/document" style="color: green; text-decoration: none;">
          Upload Your Document Here
          </a>
          </h5>
          `;
          cardBody.insertAdjacentHTML('beforebegin', message);
        }

        if (dGridContainer) {
          let message = `
          <p class="text-danger d-flex justify-content-center">
          <span class="text-danger">
          To request an item, you must submit the necessary documents.

          <a href="/user/document" style="color: green; text-decoration: none;">
          Upload Your Document Here
          </a>
          </p>
          `;
          dGridContainer.insertAdjacentHTML('beforebegin', message);
        }

        if (requestButton) {
          requestButton.disabled = true; 
          requestButton.classList.add('disabled'); 
        } 
      }

      if (customerStatus === 1) {
        document.querySelector('.container-xxl').style.display = 'block';
        const map = L.map('userLocation').setView([customerData.latitude, customerData.longitude], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);


        L.marker([customerData.latitude, customerData.longitude]).addTo(map)
        .bindPopup(`<b>${customerData.address1}</b>`)
        .openPopup();
      } else {
        document.querySelector('.container-xxl').style.display = 'none';
      }


    } else {
      errorToast(res.data.message || 'An unexpected error occurred');
    }
  } catch (error) {
    if (error.response) {
      const status = error.response.status;
      if (status === 400) {
        errorToast(error.response.data.message || 'User not found');
      } else if (status === 500) {
        errorToast(error.response.data.message || 'An error occurred on the server');
      } else {
        errorToast(error.response.data.message || 'An unexpected error occurred');
      }
    }
  } finally{
    hideLoader();
  }
}

async function shareToFacebook(event) {
  event.preventDefault();
  try {
    let res = await axios.post(`/user/facebook/share/${id}`);

    if (res.status === 200) {
      successToast(res.data.message || 'Shared successfully to Facebook.');
    } else {
      errorToast(res.data.message || "Failed to share to Facebook.");
    }
  } catch (error) {
    if (error.response) {
      if (error.response.status === 401) {
        window.location.href = '/user/login';
      } else if (error.response.status === 500) {
        errorToast(error.response.data.error || "An internal server error occurred while sharing to Facebook.");
      } else if (error.response.status === 400) {
        errorToast(error.response.data.message || "Bad request.");
      } else {
        errorToast("Failed to share to Facebook!");
      }
    } else {
      errorToast("Request failed!");
    }
    console.error(error);
  }
}

async function shareFacebookURL(event) {
  event.preventDefault();
  try {
    const response = await axios.post(`/user/facebook/url/share/${id}`);

    if (response.status === 200) {
      const shareUrl = response.data.facebook_share_url;
      window.open(shareUrl, '_blank', 'width=600,height=400');
      successToast(response.data.message || 'Sharing to Facebook...');
    } else {
      errorToast(response.data.message || 'Failed to generate share URL.');
    }
  } catch (error) {
    if (error.response) {
      if (error.response.status === 401) {
        window.location.href = '/user/login';
      } else if (error.response.status === 500) {
        errorToast(error.response.data.error || "An internal server error occurred while sharing to Facebook.");
      } else if (error.response.status === 400) {
        errorToast(error.response.data.message || "Bad request.");
      } else {
        errorToast("Failed to share to Facebook!");
      }
    } else {
      errorToast("Request failed!");
    }
    console.error(error);
  }
}
</script>

<style>
  .gallery-main {
    width: 80%;
    height: 400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background-color: #f0f0f0;
  }

  .gallery-main img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
  }

  .gallery-thumbs {
    display: flex;
    gap: 10px;
    justify-content: center;
    align-items: center;
  }

  .gallery-thumbs img {
    width: 100px; 
    min-height: 150px; 
    object-fit: cover;
    cursor: pointer;
    border: 1px solid #ddd;
  }
</style>
