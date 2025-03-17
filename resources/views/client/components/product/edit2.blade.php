<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header header-elements">
        <span class="me-2"><h5>Update Product Information</h5></span>
        <div class="card-header-elements ms-auto">
          <a href="{{ route('client.products') }}" type="button" class="btn btn-primary waves-effect waves-light">
            <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back To Product List
          </a>
        </div>
      </div>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="save-form">
          <input type="text" class="d-none" id="updateID">
          <div class="row">
            <div class="col-md-3 p-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="hasVariants" name="has_variants" />
                <label class="form-check-label" for="defaultCheck3"><span class="text-info">Product has variants (color & size)</span></label>
              </div>
            </div>
            <div class="col-md-2 p-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="hasBrand" name="has_brand" />
                <label class="form-check-label" for="defaultCheck3"><span class="text-info">Product has brand</span></label>
              </div>
            </div>
            <div class="col-md-1 p-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="isFree" name="is_free" />
                <label class="form-check-label" for="defaultCheck3"><span class="text-info">Free</span></label>
              </div>
            </div>
            <div class="col-md-2 p-2" id="discountCheckboxContainer">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="hasDiscountPrice" name="has_discount_price" />
                <label class="form-check-label" for="defaultCheck3"><span class="text-info">Discount Price</span></label>
              </div>
            </div><hr class="mt-2">
          </div>
          <div class="row">
            <div class="col-md-2" id="categoryContainer">
              <div class="form-floating form-floating-outline">
                <select id="categorySelect" class="form-select w-100" aria-label="Select Category">
                </select>
                <label for="categorySelect">Select Category<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="category-error"></span>
            </div>
            <div class="col-md-2" id="brandContainer" style="display: none;">
              <div class="form-floating form-floating-outline">
                <select id="brandSelect" class="form-select w-100" aria-label="Select Brand">

                </select>
                <label for="brandSelect">Select Brand<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="brand-error"></span>
            </div>
            <div class="col-md-4" id="nameContainer">
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="name" placeholder="Enter product name" />
                <label for="exampleFormControlInput1">Product Name<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="name-error"></span>
              </div>
            </div>
            <div class="col-md-2" id="priceContainer">
              <div class="form-floating form-floating-outline mb-4">
                <input type="number" class="form-control" id="price" min="0" step="0.01" placeholder="Enter product price" />
                <label for="price">Product Price<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="price-error"></span>
              </div>
            </div>
            <div class="col-md-2" id="discountContainer" style="display: none;">
              <div class="form-floating form-floating-outline mb-4">
                <input type="number" class="form-control" id="discountPrice" min="0" step="0.01" placeholder="Enter discount price" />
                <label for="price">Discount Price<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="discount_price-error"></span>
              </div>
            </div>
            <div class="col-md-2" id="qtyContainer">
              <div class="form-floating form-floating-outline mb-4">
                <input type="number" class="form-control" id="qty" min=0 placeholder="Enter product qty" />
                <label for="exampleFormControlInput1">Product Qty<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="qty-error"></span>
              </div>
            </div>
          </div>
          <div id="variantSection" style="display: none;">
            <div class="row variant-row">
              <div class="col-md-3">
                <div class="form-floating form-floating-outline mb-4">
                  <input type="text" class="form-control" name="color[]" placeholder="Enter product color" />
                  <label>Product Color<span class="text-danger">*</span></label>
                  <span class="error-message text-danger" id="color-error"></span>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-floating form-floating-outline mb-4">
                  <input type="text" class="form-control" name="size[]" placeholder="Enter product size" />
                  <label>Product Size<span class="text-danger">*</span></label>
                  <span class="error-message text-danger" id="size-error"></span>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating form-floating-outline mb-4">
                  <input type="number" class="form-control" name="qty2[]" min="1" placeholder="Enter product qty" />
                  <label>Product Qty<span class="text-danger">*</span></label>
                  <span class="error-message text-danger" id="qty2-error"></span>
                </div>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-primary add-variant">Add More</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text" class="form-control" id="address1" placeholder="Enter collection address" />
                <label for="exampleFormControlInput1">Collection Address1(Includes house number and street name.)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="address1-error"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="address2" placeholder="Enter collection address" />
                <label for="exampleFormControlInput1">Collection Address2</label>
                <span class="error-message text-danger" id="address2-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input type="text" class="form-control" id="zip-code" placeholder="Enter zip code" />
                <label for="zip-code">Postcode(Example: EC1A 1BB)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="zip_code-error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 mb-4">
              <div class="form-floating form-floating-outline">
                <select id="countrySelect" class="form-select w-100" aria-label="Select Country">
                </select>
                <label for="countrySelect">Select Country<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="country-error"></span>
            </div>
            <div class="col-md-4 mb-4">
              <div class="form-floating form-floating-outline">
                <select id="countySelect" class="form-select w-100" aria-label="Select County">
                </select>
                <label for="countySelect">Select County<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="county-error"></span>
            </div>
            <div class="col-md-4 mb-4">
              <div class="form-floating form-floating-outline">
                <select id="citySelect" class="form-select w-100" aria-label="Select City">
                </select>
                <label for="citySelect">Select City<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="city-error"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input type="date" class="form-control" id="expire_date" placeholder="Enter expire date" />
                <label for="exampleFormControlInput1">Expire Date<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="expire_date-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input type="date" class="form-control" id="collection_date" placeholder="Enter collection date" />
                <label for="exampleFormControlInput1">Collection Date<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="collection_date-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input type="time" class="form-control" id="start_collection_time" placeholder="Enter collection start time" />
                <label for="exampleFormControlInput1">Collection Time(From)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="start_collection_time-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input type="time" class="form-control" id="end_collection_time" placeholder="Enter collection end time" />
                <label for="exampleFormControlInput1">Collection Time(To)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="end_collection_time-error"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label for="formFile" class="form-label">Old Item Image<span class="text-danger">*</span></label><br>
                        <img src="{{ asset('/upload/no_image.jpg')}}" id="oldImg" class="mt-1" style="width: 150px; height: 100px;">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label for="formFile" class="form-label">Upload New Item Image<span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="imgUpdate" onChange="updateImgUrl(this)"/>
                        <img src="{{asset('/upload/no_image.jpg')}}" id="updateImg" class="mt-1" style="width: 150px; height: 100px;">
                      </div>
                      <span class="error-message text-danger" id="image-error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 my-4">
              <div class="card">
                <h5 class="card-header">Item Description<span class="text-danger">*</span></h5>
                <div class="card-body">
                  @include('client.components.editor')
                  <div id="snow-editor">

                  </div>
                  <span class="error-message text-danger" id="description-error"></span>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-lg">
            <i class="mdi mdi-check me-2"></i>Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function updateImgUrl(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#updateImg').attr('src',e.target.result).width(150).height(100);
      };
      reader.readAsDataURL(input.files[0]);
    }
  } 
</script>

<script>
var quill;
document.addEventListener("DOMContentLoaded", async function() {
    await productDetailsInfo();

    quill = new Quill('#snow-editor', {
        theme: 'snow',
        modules: {
            toolbar: '#toolbar'
        }
    });

    const form = document.getElementById('save-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        await updateProduct();
    });

    document.getElementById('hasVariants').addEventListener('change', function() {
        const variantSection = document.getElementById('variantSection');
        const qtyContainer = document.getElementById('qtyContainer');
        if (this.checked) {
            variantSection.style.display = 'block';
            qtyContainer.style.display = 'none';
        } else {
            variantSection.style.display = 'none';
            qtyContainer.style.display = 'block';
        }
    });

    document.getElementById('hasBrand').addEventListener('change', async function() {
        const brandContainer = document.getElementById('brandContainer');
        if (this.checked) {
            brandContainer.style.display = 'block';
            await populateBrands();
        } else {
            brandContainer.style.display = 'none';
        }
    });

    document.getElementById('isFree').addEventListener('change', function() {
        const hasDiscountCheckbox = document.getElementById('hasDiscountPrice');
        const priceContainer = document.getElementById('priceContainer');
        const discountContainer = document.getElementById('discountContainer');
        if (this.checked) {
            hasDiscountCheckbox.checked = false; 
            hasDiscountCheckbox.disabled = true; 
            priceContainer.style.display = 'none'; 
            discountContainer.style.display = 'none'; 
        } else {
            hasDiscountCheckbox.disabled = false; 
            priceContainer.style.display = 'block'; 
            if (hasDiscountCheckbox.checked) {
                discountContainer.style.display = 'block'; 
            }
        }
    });

    document.getElementById('hasDiscountPrice').addEventListener('change', function() {
        const discountContainer = document.getElementById('discountContainer');
        if (this.checked) {
            discountContainer.style.display = 'block'; 
        } else {
            discountContainer.style.display = 'none'; 
        }
    });

      // Add More button functionality
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('add-variant')) {
            addVariantRow();
        }

        // Remove button functionality
      if (event.target.classList.contains('remove-variant')) {
          const variantRow = event.target.closest('.variant-row');

          // Check if the row is a new row (not from the database)
          if (variantRow.hasAttribute('data-new-row')) {
              // If it's a new row, simply remove it from the DOM
              variantRow.remove();
          } else {
              // If it's an existing row, mark it for deletion
              const variantId = variantRow.dataset.variantId; // Get variant ID from data-variant-id
              const productId = document.getElementById('updateID').value;

              if (variantId) {
                  // Send a request to delete the variant
                  deleteVariant(productId, variantId).then(() => {
                      // Remove the row from the DOM
                      variantRow.remove();

                      // Check if no variants are left
                      const variantRows = document.querySelectorAll('.variant-row');
                      if (variantRows.length === 0) {
                          // Uncheck the hasVariants checkbox
                          document.getElementById('hasVariants').checked = false;
                          document.getElementById('variantSection').style.display = 'none';
                          document.getElementById('qtyContainer').style.display = 'block';
                      }
                  });
              }
          }
      }
    });
});

async function deleteVariant(productId, variantId) {
  showLoader();
  try {
      const response = await axios.post('/client/product/variant/delete', { product_id: productId, id: variantId });

      if (response.status === 200) {
          successToast(response.data.message || 'Variant deleted successfully.');
          window.location.reload();
      } else {
          errorToast('Failed to delete variant.');
      }
  } catch (error) {
      if (error.response) {
        if (error.response.status === 404) {
          errorToast(error.response.data.message || "Data not found.");
        } else if (error.response.status === 500) {
          errorToast(error.response.data.error || "An internal server error occurred.");
        } else {
          errorToast("Request failed!");
        }
      } 
  } finally{
    hideLoader();
  }
}
 
function addVariantRow() {
    const variantSection = document.getElementById('variantSection');
    const variantRowTemplate = document.querySelector('.variant-row').cloneNode(true);

    // Clear input values in the new row
    variantRowTemplate.querySelectorAll('input').forEach(input => input.value = '');

    // Add a unique identifier to the new row (for tracking)
    variantRowTemplate.setAttribute('data-new-row', 'true');

    // Add a Remove button to the new row
    const removeButton = document.createElement('button');
    removeButton.type = 'button';
    removeButton.classList.add('btn', 'btn-danger', 'remove-variant');
    removeButton.textContent = 'Remove';

    const removeButtonContainer = document.createElement('div');
    removeButtonContainer.classList.add('col-md-2');
    removeButtonContainer.appendChild(removeButton);

    variantRowTemplate.appendChild(removeButtonContainer); // Append Remove button to the row

    // Append the new row to the variant section
    variantSection.appendChild(variantRowTemplate);
}

async function populateBrands() {
    try {
        const brandsResponse = await axios.get('/brands');
        const brandSelect = document.getElementById('brandSelect');
        brandSelect.innerHTML = '<option value="">Select Brand</option>';
        brandsResponse.data.data.forEach(brand => {
            const option = document.createElement('option');
            option.value = brand.id;
            option.textContent = brand.name;
            brandSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching brands:', error);
    }
}

async function productDetailsInfo() {
    showLoader();
    try {
        let url = window.location.pathname;
        let segments = url.split('/');
        let id = segments[segments.length - 1];

        let res = await axios.get("/client/product/info/" + id);
        console.log('--------------',res);
        const productData = res.data.data;

        const hasVariantsCheckbox = document.getElementById('hasVariants');
        const hasBrandCheckbox = document.getElementById('hasBrand');
        const hasFreeCheckbox = document.getElementById('isFree');
        const hasDiscountCheckbox = document.getElementById('hasDiscountPrice');

        hasVariantsCheckbox.checked = productData['has_variants'] ? productData['has_variants'] : 0;
        hasBrandCheckbox.checked = productData['has_brand'] ? productData['has_brand'] : 0;
        hasFreeCheckbox.checked = productData['is_free'] ? productData['is_free'] : 0;
        hasDiscountCheckbox.checked = productData['has_discount_price'] ? productData['has_discount_price'] : 0;

        const variantSection = document.getElementById('variantSection');
        const qtyContainer = document.getElementById('qtyContainer');
        if (productData['has_variants'] === 1) {
            variantSection.style.display = 'block';
            qtyContainer.style.display = 'none';
            if (productData.variants && productData.variants.length > 0) {
                const variantRowTemplate = document.querySelector('.variant-row').cloneNode(true);
                const variantContainer = document.getElementById('variantSection');
                variantContainer.innerHTML = ''; // Clear existing rows

                productData.variants.forEach(variant => {
                    const newRow = variantRowTemplate.cloneNode(true);

                    // Populate variant data
                    newRow.querySelector('input[name="color[]"]').value = variant.color;
                    newRow.querySelector('input[name="size[]"]').value = variant.size;
                    newRow.querySelector('input[name="qty2[]"]').value = variant.qty;

                    // Set the data-variant-id attribute
                    newRow.setAttribute('data-variant-id', variant.id);

                    // Add a Remove button
                    const removeButton = document.createElement('button');
                    removeButton.type = 'button';
                    removeButton.classList.add('btn', 'btn-danger', 'remove-variant');
                    removeButton.textContent = 'Remove';

                    const removeButtonContainer = document.createElement('div');
                    removeButtonContainer.classList.add('col-md-2');
                    removeButtonContainer.appendChild(removeButton);

                    newRow.appendChild(removeButtonContainer); 

                    variantContainer.appendChild(newRow); // Append the new row to the variant section
                });

                // Add event listener for Remove buttons
                document.addEventListener('click', function (event) {
                    if (event.target.classList.contains('remove-variant')) {
                        const variantRow = event.target.closest('.variant-row');
                        const variantId = variantRow.dataset.variantId; // Get variant ID from data-variant-id
                        const productId = document.getElementById('updateID').value;

                        if (variantId) {
                            // Send a request to delete the variant
                            deleteVariant(productId, variantId).then(() => {
                                // Remove the row from the DOM
                                variantRow.remove();

                                // Check if no variants are left
                                const variantRows = document.querySelectorAll('.variant-row');
                                if (variantRows.length === 0) {
                                    // Uncheck the hasVariants checkbox
                                    document.getElementById('hasVariants').checked = false;
                                    document.getElementById('variantSection').style.display = 'none';
                                    document.getElementById('qtyContainer').style.display = 'block';
                                }
                            });
                        } else {
                            // If no variant ID (newly added row), just remove the row
                            variantRow.remove();

                            // Check if no variants are left
                            const variantRows = document.querySelectorAll('.variant-row');
                            if (variantRows.length === 0) {
                                // Uncheck the hasVariants checkbox
                                document.getElementById('hasVariants').checked = false;
                                document.getElementById('variantSection').style.display = 'none';
                                document.getElementById('qtyContainer').style.display = 'block';
                            }
                        }
                    }
                });
            }
        } else {
            variantSection.style.display = 'none';
            qtyContainer.style.display = 'block';
        }

        const brandContainer = document.getElementById('brandContainer');
        if (productData['has_brand'] === 1) {
            brandContainer.style.display = 'block';
            await populateBrands();
            const brandSelect = document.getElementById('brandSelect');
            if (productData.brand_id) {
                brandSelect.value = productData.brand_id;
            }
        } else {
            brandContainer.style.display = 'none';
        }

        document.getElementById('updateID').value = id;
        document.getElementById('name').value = productData['name'];
        document.getElementById('price').value = productData['price'];
        document.getElementById('address1').value = productData['address1'];
        document.getElementById('address2').value = productData['address2'];
        document.getElementById('zip-code').value = productData['zip_code'];

        const categoriesResponse = await axios.get('/categories');
        const categorySelect = document.getElementById('categorySelect');
        categorySelect.innerHTML = '<option value="">Select Category</option>';
        categoriesResponse.data.data.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            if (productData.category_id === category.id) {
                option.selected = true;
            }
            categorySelect.appendChild(option);
        });

        const countriesResponse = await axios.get('/countries');
        const countrySelect = document.getElementById('countrySelect');
        countrySelect.innerHTML = '<option value="">Select Country</option>';
        countriesResponse.data.data.forEach(country => {
            const option = document.createElement('option');
            option.value = country.id;
            option.textContent = country.name;
            if (productData.country_id === country.id) {
                option.selected = true;
            }
            countrySelect.appendChild(option);
        });

        await loadCounties(productData.country_id || '', productData.county_id || '');
        countrySelect.addEventListener('change', async function () {
            await loadCounties(this.value);
        });

        await loadCities(productData.county_id || '', productData.city_id || '');
        const countySelect = document.getElementById('countySelect');
        countySelect.addEventListener('change', async function () {
            await loadCities(this.value);
        });

        document.getElementById('expire_date').value = productData['expire_date'];
        document.getElementById('collection_date').value = productData['collection_date'];
        document.getElementById('start_collection_time').value = productData['start_collection_time'];
        document.getElementById('end_collection_time').value = productData['end_collection_time'];

        const imageElement = document.getElementById('oldImg');
        if (productData['image']) {
            imageElement.src = `/upload/product/medium/${productData['image']}`; 
        } else {
            imageElement.src = '/upload/no_image.jpg'; 
        }

        document.getElementById('snow-editor').innerHTML = productData['description'];

    } catch (error) {
        if (error.response) {
            if (error.response.status === 404) {
                errorToast(error.response.data.message || "Data not found.");
            } else if (error.response.status === 500) {
                errorToast(error.response.data.error || "An internal server error occurred."); 
            } else {
                errorToast("Request failed!");
            }
        } else {
            errorToast("Request failed! Please check your internet connection or try again later.");
        }
    } finally {
        hideLoader();
    }
}

async function loadCounties(countryId, selectedCountyId = '') {
  const countySelect = document.getElementById('countySelect');
  countySelect.innerHTML = '<option value="">Select County</option>';
  if (countryId) {
    const countiesResponse = await axios.get(`/counties/${countryId}`);
    countiesResponse.data.data.forEach(county => {
      const option = document.createElement('option');
      option.value = county.id;
      option.textContent = county.name;
      if (selectedCountyId === county.id) {
        option.selected = true;
      }
      countySelect.appendChild(option);
    });
  }
}

async function loadCities(countyId, selectedCityId = '') {
  const citySelect = document.getElementById('citySelect');
  citySelect.innerHTML = '<option value="">Select City</option>';
  if (countyId) {
    const citiesResponse = await axios.get(`/cities/${countyId}`);
    citiesResponse.data.data.forEach(city => {
      const option = document.createElement('option');
      option.value = city.id;
      option.textContent = city.name;
      if (selectedCityId === city.id) {
        option.selected = true;
      }
      citySelect.appendChild(option);
    });
  }
}

function resetCreateForm() {
    document.getElementById('save-form').reset();
    $('#mainImage').attr('src', '');
    $('#multiImage').empty();
    quill.setContents([]);
}

async function updateProduct() {
  let isValid = true;
  document.querySelectorAll(".error-message").forEach(span => span.innerText = '');

  let updateID = document.getElementById('updateID').value;
  let name = document.getElementById('name').value.trim();
  let category_id = document.getElementById('categorySelect').value;
  let qty = document.getElementById('qty').value.trim();
  let address1 = document.getElementById('address1').value.trim();
  let address2 = document.getElementById('address2').value.trim();
  let country_id = document.getElementById('countrySelect').value;
  let county_id = document.getElementById('countySelect').value;
  let city_id = document.getElementById('citySelect').value;
  let zip_code = document.getElementById('zip-code').value.trim();
  let expire_date = document.getElementById('expire_date').value;
  let collection_date = document.getElementById('collection_date').value;
  let start_collection_time = document.getElementById('start_collection_time').value;
  let end_collection_time = document.getElementById('end_collection_time').value;
  let description = quill.root.innerHTML.trim();
  let image = document.getElementById('imgUpdate').files[0];
  let hasVariants = document.getElementById('hasVariants').checked ? 1 : 0;
  let hasBrand = document.getElementById('hasBrand').checked ? 1 : 0;
  let hasDiscountPrice = document.getElementById('hasDiscountPrice').checked ? 1 : 0;
  let isFree = document.getElementById('isFree').checked ? 1 : 0;

  if (!name) {
    document.getElementById('name-error').innerText = 'Product name is required!';
    isValid = false;
  }
  if (!category_id) {
    document.getElementById('category-error').innerText = 'Category is required!';
    isValid = false;
  }
  if (!address1) {
    document.getElementById('address1-error').innerText = 'Address1 is required!';
    isValid = false;
  }
  if (!country_id) {
    document.getElementById('country-error').innerText = 'Country is required!';
    isValid = false;
  }
  if (!county_id) {
    document.getElementById('county-error').innerText = 'County is required!';
    isValid = false;
  }
  if (!city_id) {
    document.getElementById('city-error').innerText = 'City is required!';
    isValid = false;
  }
  if (!zip_code) {
    document.getElementById('zip_code-error').innerText = 'Zip code is required!';
    isValid = false;
  }
  if (!expire_date) {
    document.getElementById('expire_date-error').innerText = 'Expire date is required!';
    isValid = false;
  }
  if (!collection_date) {
    document.getElementById('collection_date-error').innerText = 'Collection date is required!';
    isValid = false;
  }
  if (!start_collection_time) {
    document.getElementById('start_collection_time-error').innerText = 'Start collection time is required!';
    isValid = false;
  }
  if (!end_collection_time) {
    document.getElementById('end_collection_time-error').innerText = 'End collection time is required!';
    isValid = false;
  }
  if (!quill.getText().trim()) {
    document.getElementById('description-error').innerText = 'Description is required!';
    isValid = false;
  } 
  if (quill.getText().trim().length < 10) {
    document.getElementById('description-error').innerText = 'Description must be at least 10 characters!';
    isValid = false;
  }

  let brand_id = null;
  if (hasBrand && !brand_id) {
    document.getElementById('brand-error').innerText = 'Please select a brand!';
    isValid = false;
  }

  let price = 0.00;
  if (!isFree) {
    price = document.getElementById('price').value.trim();
    let priceValue = parseFloat(price);
    if (isNaN(priceValue)) {
      document.getElementById('price-error').innerText = 'Price must be a valid number!';
      isValid = false;
    } else if (priceValue <= 0) {
      document.getElementById('price-error').innerText = 'Price must be greater than 0!';
      isValid = false;
    }
  }

  let discount_price = 0.00;
  if (!isFree && hasDiscountPrice) {
    discountPrice = document.getElementById('discountPrice').value.trim();
    let discountPriceValue = parseFloat(discountPrice);
    if (isNaN(discountPriceValue)) {
      document.getElementById('discount_price-error').innerText = 'Discount price must be a valid number!';
      isValid = false;
    } else if (discountPriceValue <= 0) {
      document.getElementById('discount_price-error').innerText = 'Discount price must be greater than 0!';
      isValid = false;
    }
  }

  if (hasVariants) {
    let variantRows = document.querySelectorAll(".variant-row");
    variantRows.forEach((row, index) => {
      let colorInput = row.querySelector('input[name="color[]"]').value.trim();
      let sizeInput = row.querySelector('input[name="size[]"]').value.trim();
      let qtyInput = row.querySelector('input[name="qty2[]"]').value.trim();

      let colorError = row.querySelector('#color-error');
      let sizeError = row.querySelector('#size-error');
      let qtyError = row.querySelector('#qty2-error');

      if (!colorInput) {
        colorError.innerText = 'Color is required!';
        isValid = false;
      }
      if (!sizeInput) {
        sizeError.innerText = 'Size is required!';
        isValid = false;
      }
      if (!qtyInput || parseInt(qtyInput) <= 0) {
        qtyError.innerText = 'Quantity must be greater than 0!';
        isValid = false;
      }
    });
  } else {
    if (!qty || parseInt(qty) <= 0) {
      document.getElementById('qty-error').innerText = 'Quantity must be greater than 0!';
      isValid = false;
    }
  }

  if (!isValid) return;

  let formData = new FormData();
  formData.append('id', updateID);
  formData.append('name', name);
  formData.append('category_id', category_id);
  formData.append('address1', address1);
  formData.append('address2', address2);
  formData.append('country_id', country_id);
  formData.append('county_id', county_id);
  formData.append('city_id', city_id);
  formData.append('zip_code', zip_code);
  formData.append('expire_date', expire_date);
  formData.append('collection_date', collection_date);
  formData.append('start_collection_time', start_collection_time);
  formData.append('end_collection_time', end_collection_time);
  formData.append('description', description);
  formData.append('has_variants', hasVariants);
  formData.append('has_brand', hasBrand);
  formData.append('has_discount_price', hasBrand);
  formData.append('is_free', isFree);

  if (image) {
      formData.append('image', image);
  }
  
  if (hasBrand && brand_id) {
    formData.append('brand_id', brand_id);
  }

  if (!isFree && price) {
    formData.append('price', price);
  }

  if (!isFree && hasDiscountPrice) {
    formData.append('discount_price', discount_price);
  }

  if (hasVariants) {
    let variantRows = document.querySelectorAll(".variant-row");
    variantRows.forEach((row, index) => {
      let colorInput = row.querySelector('input[name="color[]"]').value.trim();
      let sizeInput = row.querySelector('input[name="size[]"]').value.trim();
      let qtyInput = row.querySelector('input[name="qty2[]"]').value.trim();

      formData.append(`variants[${index}][color]`, colorInput);
      formData.append(`variants[${index}][size]`, sizeInput);
      formData.append(`variants[${index}][qty2]`, qtyInput);
    });
  } else {
    formData.append('qty', qty);
  }

  console.log('---------------',formData);

  const config = {
      headers: {'content-type': 'multipart/form-data'}
  };

  try {
      let res = await axios.post("/client/update/product", formData, config);
      if (res.status === 200) {
          successToast(res.data.message || 'Update Success');
          window.location.href = '/client/product-list';
          resetCreateForm(); 
      } else {
          errorToast(res.data.message || "Request failed");
      }
  } catch (error) {
      if (error.response && error.response.status === 422) {
          let errorMessages = error.response.data.errors;
          document.querySelectorAll(".error-message").forEach(span => span.innerText = '');

          for (let field in errorMessages) {
              if (errorMessages.hasOwnProperty(field)) {
                if (field === 'variants') {
                    // Show error under every variant row
                    const variantRows = document.querySelectorAll(".variant-row");
                    variantRows.forEach(row => {
                        // Target the color/size error spans in this row
                        const colorError = row.querySelector('#color-error');
                        const sizeError = row.querySelector('#size-error');
                        if (colorError) colorError.innerText = errorMessages[field][0];
                        if (sizeError) sizeError.innerText = errorMessages[field][0];
                    });
                } else {
                    // Handle other fields normally
                    const errorElement = document.getElementById(`${field}-error`);
                    if (errorElement) {
                        errorElement.innerText = errorMessages[field][0];
                    }
                }
              }
          }

      } else if (error.response && error.response.status === 400) {
          errorToast(error.response.data.message || "Invalid address or coordinates not found.");
      } else if (error.response && error.response.status === 500) {
          errorToast(error.response.data.error);
      } else {
          errorToast("Request failed!");
      }
  }
}


function handleError(error) {
    if (error.response) {
        const status = error.response.status;
        const message = error.response.data.message || 'An unexpected error occurred';

        if (status === 400) {
            errorToast(message || 'Bad Request');
        } else if (status === 500) {
            errorToast(message || 'Server Error');
        } else {
            errorToast(message);
        }
    }
}
</script>

