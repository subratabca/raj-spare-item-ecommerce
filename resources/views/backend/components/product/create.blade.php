<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header header-elements">
          <span class="me-2"><h5>Add New Item</h5></span>
          <div class="card-header-elements ms-auto">
              <a href="{{ route('foods') }}" type="button" class="btn btn-primary waves-effect waves-light">
                  <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back To Item List
              </a>
          </div>
      </div>
      <div class="card-body demo-vertical-spacing demo-only-element">
        <form id="save-form">
          <div class="row">
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
                  id="clientSelect"
                  class="form-select w-100"
                  aria-label="Select Client">
                </select>
                <label for="clientSelect">Select Client<span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="client-error"></span>
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
            <div class="col-md-3">
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
            <div class="col-md-3">
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

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Upload Item Image<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="image" onChange="mainImageUrl(this)"/>
                    <img src="{{asset('/upload/no_image.jpg')}}" id="mainImage" class="mt-1" style="width: 150px; height: 100px;">
                  </div>
                  <span class="error-message text-danger" id="image-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Multiple Image(maximum 2 images)<span class="text-danger">*</span></label>
                    <input class="form-control" type="file" id="multi_image" multiple onChange="multiImageUrl(this)"/>
                  </div>
                  <span class="error-message text-danger" id="multi_image-error"></span>
                  <div id="multiImage" class="mt-1" style="display: flex; gap: 5px;">
                    <img src="{{asset('/upload/no_image.jpg')}}" id="defaultImage" style="width: 150px; height: 100px;">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 my-4">
              <div class="card">
                <h5 class="card-header">Item Description<span class="text-danger">*</span></h5>
                <div class="card-body">
                   @include('backend.components.editor')
                  <div id="snow-editor">

                  </div>
                  <span class="error-message text-danger" id="description-error"></span>
                </div>
              </div>
            </div>

            <div class="col-md-12 p-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="accept_tnc" />
                <label class="form-check-label" for="defaultCheck3"><a href="/admin/terms-conditions/food_upload" target="_blank">Accept T&C For Item Upload</a><span class="text-danger">*</span></label>
              </div>
              <span class="error-message text-danger" id="accept_tnc-error"></span>
            </div>

          </div>
          <button type="submit" class="btn btn-primary btn-lg">
            <i class="mdi mdi-check me-2"></i>Confirm
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var quill;
  document.addEventListener("DOMContentLoaded", async function() {
      const clientSelect = document.querySelector('#clientSelect');
      const categorySelect = document.querySelector('#categorySelect');
      const countrySelect = document.querySelector('#countrySelect');
      const countySelect = document.querySelector('#countySelect');
      const citySelect = document.querySelector('#citySelect');

      clientSelect.innerHTML = '<option value="" disabled selected>Select Client</option>';
      categorySelect.innerHTML = '<option value="" disabled selected>Select Category</option>';
      countrySelect.innerHTML = '<option value="" disabled selected>Select Country</option>';
      countySelect.innerHTML = '<option value="" disabled selected>Select County</option>';
      citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';


      try {
          const response = await axios.get('/clients');
          response.data.data.forEach(client => {
              const option = document.createElement('option');
              option.value = client.id;
              option.textContent = client.lastName ? `${client.firstName} ${client.lastName}` : client.firstName;
              clientSelect.appendChild(option);
          });
      } catch (error) {
          if (error.response && error.response.status === 500) {
              errorToast(error.response.data.error);
          } else {
              errorToast("Failed to load client list. Please try again later.");
          }
      }


      try {
          const response = await axios.get('/categories');
          response.data.data.forEach(category => {
              const option = document.createElement('option');
              option.value = category.id;
              option.textContent = category.name;
              categorySelect.appendChild(option);
          });
      } catch (error) {
          if (error.response && error.response.status === 500) {
              errorToast(error.response.data.error);
          } else {
              errorToast("Failed to load categories. Please try again later.");
          }
      }


      try {
          const response = await axios.get('/countries');
          response.data.data.forEach(country => {
              const option = document.createElement('option');
              option.value = country.id;
              option.textContent = country.name;
              countrySelect.appendChild(option);
          });
      } catch (error) {
          if (error.response && error.response.status === 500) {
              errorToast(error.response.data.error);
          } else {
              errorToast("Failed to load countries. Please try again later.");
          }
      }

      countrySelect.addEventListener('change', async function() {
          const selectedCountryId = this.value;
          await loadCounties(selectedCountryId);
      });

      async function loadCounties(countryId) {
          countySelect.innerHTML = '<option value="" disabled selected>Select County</option>';
          citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

          try {
              const response = await axios.get(`/counties/${countryId}`);
              response.data.data.forEach(county => {
                  const option = document.createElement('option');
                  option.value = county.id;
                  option.textContent = county.name;
                  countySelect.appendChild(option);
              });
          } catch (error) {
              if (error.response && error.response.status === 500) {
                  errorToast(error.response.data.error);
              } else {
                  errorToast("Failed to load counties. Please try again later.");
              }
          }
      }

      countySelect.addEventListener('change', async function() {
          const selectedCountyId = this.value;
          await loadCities(selectedCountyId);
      });

      async function loadCities(countyId) {
          citySelect.innerHTML = '<option value="" disabled selected>Select City</option>';

          try {
              const response = await axios.get(`/cities/${countyId}`);
              response.data.data.forEach(city => {
                  const option = document.createElement('option');
                  option.value = city.id;
                  option.textContent = city.name;
                  citySelect.appendChild(option);
              });
          } catch (error) {
              if (error.response && error.response.status === 500) {
                  errorToast(error.response.data.error);
              } else {
                  errorToast("Failed to load cities. Please try again later.");
              }
          }
      }

      quill = new Quill('#snow-editor', {
          theme: 'snow',
          modules: {
              toolbar: '#toolbar'
          }
      });

      const form = document.getElementById('save-form');
      form.addEventListener('submit', async function(event) {
          event.preventDefault();
          await Save();
      });

  });



  function mainImageUrl(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#mainImage').attr('src', e.target.result).width(150).height(100);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }


  function multiImageUrl(input) {
    $('#multiImage').empty();

    if (input.files) {
      Array.from(input.files).forEach(file => {
        let reader = new FileReader();
        reader.onload = function (e) {
          $('#multiImage').append(`
            <img src="${e.target.result}" class="mt-1" style="width: 150px; height: 100px; margin-right: 5px;">
          `);
        };
        reader.readAsDataURL(file);
      });
    }
  }


  function resetCreateForm() {
    document.getElementById('save-form').reset();
    $('#mainImage').attr('src', '');
    $('#multiImage').empty();
    quill.setContents([]);
    $('#accept_tnc').prop('checked', false);
  }


  async function Save() {
    let name = document.getElementById('name').value;
    let client_id = document.getElementById('clientSelect').value;
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
    let image = document.getElementById('image').files[0];
    let multiImages = document.getElementById('multi_image').files;
    let accept_tnc = document.getElementById('accept_tnc').checked ? 1 : 0;


    document.getElementById('name-error').innerText = '';
    document.getElementById('client-error').innerText = '';
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
    document.getElementById('multi_image-error').innerText = '';
    document.getElementById('accept_tnc-error').innerText = '';

    if (name.length === 0) {
      errorToast("Item name required !");
    } 
    else if (client_id.length === 0) {
      errorToast("Client required !");
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
      errorToast("Item colletion date required !");
    }
    else if (start_collection_time.length === 0) {
      errorToast("Item colletion start time required !");
    }
    else if (end_collection_time.length === 0) {
      errorToast("Item colletion end time required !");
    }
    else if (quill.getText().trim().length === 0) {  
        errorToast("Item description required !");
    }
    else if (quill.getText().trim().length < 10) {
        errorToast("Item description must be at least 10 characters long!");
    }
    else if (!accept_tnc) {
        errorToast("You must accept the terms and conditions!");
    }
    else if (!image) {
      errorToast("Food image required !");
    } 
    else if (!multiImages) {
      errorToast("Multiple image required !");
    }   
    else {
      let formData = new FormData();
      formData.append('name', name);
      formData.append('client_id', client_id);
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
      formData.append('accept_tnc', accept_tnc);
      formData.append('image', image);

      let multiImages = document.getElementById('multi_image').files;
      Array.from(multiImages).forEach((file, index) => {
          formData.append(`multi_images[${index}]`, file);
      });

      const config = {
        headers: {
          'content-type': 'multipart/form-data',
        },
      };

      try {
        let res = await axios.post("/admin/store/food", formData, config);
        if (res.status === 201) {
          successToast(res.data.message || 'Request success');
          window.location.href = '/admin/food-list';
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
</script>

