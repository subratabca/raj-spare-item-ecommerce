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
          <div class="row">
            <input type="text" class="d-none" id="updateID">
            <div class="col-md-2">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter food name" />
                <label for="exampleFormControlInput1">Item Name<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="name-error"></span>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-floating form-floating-outline">
                <select
                  id="categorySelect"
                  class="form-select w-100"
                  aria-label="Select Category">
                </select>
                <label for="categorySelect">Select Category<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="category-error"></span>
            </div>
            <div class="col-md-4">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="address1"
                placeholder="Enter food collection address" />
                <label for="exampleFormControlInput1">Collection Address1(Includes house number and street name.)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="address1-error"></span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="text"
                class="form-control"
                id="address2"
                placeholder="Enter food collection address" />
                <label for="exampleFormControlInput1">Collection Address2</label>
                <span class="error-message text-danger" id="address2-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                  type="text"
                  class="form-control"
                  id="zip-code"
                  placeholder="Enter zip code" />
                <label for="zip-code">Postcode(Example: EC1A 1BB)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="zip_code-error"></span>
              </div>
            </div>
            <div class="col-md-3 mb-4">
              <div class="form-floating form-floating-outline">
                <select
                  id="countrySelect"
                  class="form-select w-100"
                  aria-label="Select Country">
                </select>
                <label for="countrySelect">Select Country<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="country-error"></span>
            </div>

            <div class="col-md-3 mb-4">
              <div class="form-floating form-floating-outline">
                <select
                  id="countySelect"
                  class="form-select w-100"
                  aria-label="Select County">
                </select>
                <label for="countySelect">Select County<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="county-error"></span>
            </div>

            <div class="col-md-3 mb-4">
              <div class="form-floating form-floating-outline">
                <select
                  id="citySelect"
                  class="form-select w-100"
                  aria-label="Select City">
                </select>
                <label for="citySelect">Select City<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="city-error"></span>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="date"
                class="form-control"
                id="expire_date"
                placeholder="Enter food expire date" />
                <label for="exampleFormControlInput1">Expire Date<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="expire_date-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="date"
                class="form-control"
                id="collection_date"
                placeholder="Enter food collection date" />
                <label for="exampleFormControlInput1">Collection Date<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="collection_date-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="time"
                class="form-control"
                id="start_collection_time"
                placeholder="Enter food collection start time" />
                <label for="exampleFormControlInput1">Collection Time(From)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="start_collection_time-error"></span>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-floating form-floating-outline mb-4">
                <input
                type="time"
                class="form-control"
                id="end_collection_time"
                placeholder="Enter food collection end time" />
                <label for="exampleFormControlInput1">Collection Time(To)<span class="text-danger">*</span></label>
                <span class="error-message text-danger" id="end_collection_time-error"></span>
              </div>
            </div>

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

});



async function productDetailsInfo() {
    showLoader();
    try {
        let url = window.location.pathname;
        let segments = url.split('/');
        let id = segments[segments.length - 1];

        let res = await axios.get("/client/product/info/" + id);
        const productData = res.data.data;

        document.getElementById('updateID').value = id;
        document.getElementById('name').value = productData['name'];
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
            imageElement.src = `/upload/food/medium/${productData['image']}`; 
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
    let name = document.getElementById('name').value;
    let category_id = document.getElementById('categorySelect').value;
    let address1 = document.getElementById('address1').value;
    let address2 = document.getElementById('address2').value;
    let country_id = document.getElementById('countrySelect').value;
    let county_id = document.getElementById('countySelect').value;
    let city_id = document.getElementById('citySelect').value;
    let zip_code = document.getElementById('zip-code').value;

    let expire_date = document.getElementById('expire_date').value;
    let collection_date = document.getElementById('collection_date').value;
    let start_collection_time = document.getElementById('start_collection_time').value;
    let end_collection_time = document.getElementById('end_collection_time').value;
    let description = quill.root.innerHTML.trim();

    let image = document.getElementById('imgUpdate').files[0];
    let updateID = document.getElementById('updateID').value;


    document.getElementById('name-error').innerText = '';
    document.getElementById('category-error').innerText = '';
    document.getElementById('address1-error').innerText = '';
    document.getElementById('address2-error').innerText = '';

    document.getElementById('country-error').innerText = '';
    document.getElementById('county-error').innerText = '';
    document.getElementById('city-error').innerText = '';
    document.getElementById('zip_code-error').innerText = '';

    document.getElementById('expire_date-error').innerText = '';
    document.getElementById('collection_date-error').innerText = '';
    document.getElementById('start_collection_time-error').innerText = '';
    document.getElementById('end_collection_time-error').innerText = '';
    document.getElementById('description-error').innerHTML = '';
    document.getElementById('image-error').innerText = '';

    if (name.length === 0) {
        errorToast("Item name required !");
    } 
    else if (category_id.length === 0) {
      errorToast("Category required !");
    }
    else if (address1.length === 0) {
      errorToast("Address1 required !");
    }
    else if (country_id.length === 0) {
      errorToast("Country required !");
    }
    else if (county_id.length === 0) {
      errorToast("County required !");
    }
    else if (city_id.length === 0) {
      errorToast("City required !");
    }
    else if (zip_code.length === 0) {
      errorToast("Zip code required !");
    }
    else if (expire_date.length === 0) {
        errorToast("Item expire date required !");
    }
    else if (collection_date.length === 0) {
        errorToast("Item collection date required !");
    }
    else if (start_collection_time.length === 0) {
        errorToast("Item collection start time required !");
    }
    else if (end_collection_time.length === 0) {
        errorToast("Item collection end time required !");
    }
    else if (quill.getText().trim().length === 0) {  
        errorToast("Item description required!");
    }
    else if (quill.getText().trim().length < 10) {
        errorToast("Item description must be at least 10 characters long!");
    }
    else {
        let formData = new FormData();
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
        if (image) {
            formData.append('image', image);
        }
        formData.append('id', updateID);

        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        };

        try {
            let res = await axios.post("/client/update/food", formData, config);
            if (res.status === 200) {
                successToast(res.data.message || 'Update Success');
                window.location.href = '/client/food-list';
                resetCreateForm(); 
            } else {
                errorToast(res.data.message || "Request failed");
            }
        } catch (error) {
            if (error.response && error.response.status === 422) {
                let errorMessages = error.response.data.errors;
                for (let field in errorMessages) {
                    if (errorMessages.hasOwnProperty(field)) {
                        document.getElementById(`${field}-error`).innerText = errorMessages[field][0];
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


