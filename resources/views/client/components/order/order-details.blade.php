<div class="card mb-5">
        <div class="card-header header-elements">
            <span class="me-2"><h5>Order Details Information</h5></span>
            <div class="card-header-elements ms-auto">
                <a href="{{ route('client.orders') }}" type="button" class="btn btn-primary waves-effect waves-light">
                    <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back To Order List
                </a>
            </div>
        </div>
        <div class="card-body">
            <input type="text" class="d-none" id="orderID">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th><strong>Item Image :</strong></th>
                            <td>
                                <img style="width: 150px; height: 100px;" id="food-image" src="{{asset('/upload/no_image.jpg')}}" alt="Food Image" />
                                <span id="food-images-container"></span>
                            </td>
                        </tr>
                        <tr>
                            <th><strong>Item Name :</strong></th>
                            <td id="food-name"></td>
                        </tr>
                        <tr>
                            <th><strong>Item Description :</strong></th>
                            <td id="food-description"></td>
                        </tr>
                        <tr>
                            <th><strong>Collection Address :</strong></th>
                            <td id="food-collection-address"></td>
                        </tr>
                        <tr>
                            <th><strong>Collection Date :</strong></th>
                            <td id="food-collection-date"></td>
                        </tr>
                        <tr>
                            <th><strong>Collection Time :</strong></th>
                            <td id="food-collection-time"></td>
                        </tr>
                        <tr>
                            <th><strong>Item Provider :</strong></th>
                            <td id="food-provider"></td>
                        </tr>
                        <tr>
                            <th><strong>Item Request By :</strong></th>
                            <td id="food-requester"></td>
                        </tr>
                        <tr>
                            <th><strong>Requester Email :</strong></th>
                            <td id="food-requester-email"></td>
                        </tr>
                        <tr>
                            <th><strong>Requester Phone :</strong></th>
                            <td id="food-requester-phone"></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="/client/terms-conditions/food_upload" target="_blank"><strong>Item Upload T&C :</strong></a>
                            </th>
                            <td id="food-upload-tnc"></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="/client/terms-conditions/request_approve" target="_blank"><strong>Order Request T&C :</strong></a>
                            </th>
                            <td id="food-order-request-tnc"></td>
                        </tr>
                        <tr>
                            <th>
                                <a href="/client/terms-conditions/food_deliver" target="_blank"><strong>Item Delivery T&C :</strong></a>
                            </th>
                            <td id="food-delivery-tnc"></td>
                        </tr>
                        <tr>
                            <th><strong>Order Status :</strong></th>
                            <td id="food-delivery-status"></td>
                        </tr>

                        <tbody id="accept-tnc-row">

                        </tbody>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
          <button id="approve-food-request-btn" class="btn btn-success d-none pd-x-20">Approved</button>
          <button id="deliver-food-request-btn" class="btn btn-info d-none pd-x-20">Delivered</button>
          <button id="cancel-food-request-btn" class="btn btn-primary d-none pd-x-20">Cancel</button>
          <button id="complain-food-request-btn" class="btn btn-info  d-none pd-x-20">Complain</button>
          <button id="ban-food-request-btn" class="btn btn-danger  d-none pd-x-20">Banned</button>
        </div>
</div>


<div class="card mb-5">
    <div class="card-header header-elements">
        <span class="me-2"><h5 class="text-danger">Order Schedule Details</h5></span>
        <div class="card-header-elements ms-auto">
            <a href="{{ route('client.orders') }}" type="button" class="btn btn-primary waves-effect waves-light">
                <span class="tf-icon mdi mdi-arrow-left me-1"></span>Back To Order List
            </a>
        </div>
    </div>
    <div class="card-body" style="margin-top: 0px; padding-top: 0px;">
        <div class="table-responsive">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Order Date</th>
                      <th>Order Time</th>
                      <th>Approve Date</th>
                      <th>Approve Time</th>
                      <th>Delivery Date</th>
                      <th>Delivery Time</th>
                  </tr>
              </thead>
              <tbody id="tableList1">
                  
              </tbody>
          </table>
        </div>
    </div>
</div>


<div class="card">
  <h5 class="card-header">Customer Location Map</h5>
  <div class="card-body">
    <div class="leaflet-map" id="customerLocation"></div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    OrderDetailsInfo();
  });

  async function OrderDetailsInfo() {
    showLoader();
    try {
      let url = window.location.pathname;
      let segments = url.split('/');
      let id = segments[segments.length - 1];

      document.getElementById('orderID').value = id;

      let res = await axios.get("/client/order/details/info/" + id);
      let data = res.data.data;
      let foodImages = data.food.food_images;

      let parser = new DOMParser();
      let doc = parser.parseFromString(data['food']['description'], 'text/html');

      let collectionDate = new Date(data['food']['collection_date']);
      let formattedDate = collectionDate.toLocaleDateString('en-GB', {
          day: '2-digit',
          month: 'long',
          year: 'numeric'
      });

      let formattedStartTime = formatTime(data['food']['start_collection_time']);
      let formattedEndTime = formatTime(data['food']['end_collection_time']);

      document.getElementById('food-image').src = `/upload/food/small/${data['food']['image']}`;
      document.getElementById('food-name').innerText = data['food']['name'];
      document.getElementById('food-description').innerText = doc.body.textContent;
      document.getElementById('food-collection-address').innerText = data['food']['address'];
      document.getElementById('food-collection-date').innerText = `${formattedDate}`;
      document.getElementById('food-collection-time').innerText = `${formattedStartTime} - ${formattedEndTime}`;
      document.getElementById('food-provider').innerText = data['food']['user']['firstName'];
      document.getElementById('food-requester').innerText = data['user']['firstName'];
      document.getElementById('food-requester-email').innerText = data['user']['email'];

      let mobileNumber = data['user']['mobile'];
      let phoneBadge = mobileNumber
      ? `<span class="badge bg-success">${mobileNumber}</span>`
      : `<span class="badge bg-info">Contact Number Not Found</span>`;

      document.getElementById('food-requester-phone').innerHTML = phoneBadge;

      let status = data['status'];
      let badgeClass = status === 'pending' ? 'bg-danger' : 'bg-success';
      document.getElementById('food-delivery-status').innerHTML = `<span class="badge ${badgeClass}">${status}</span>`;

      const approveButton = document.getElementById('approve-food-request-btn');
      if (status === 'pending') {
        approveButton.classList.remove('d-none');
        approveButton.style.display = 'inline-block';
      } else {
        approveButton.classList.add('d-none');
      }
      approveButton.addEventListener('click', approveFoodRequest);

      const deliverButton = document.getElementById('deliver-food-request-btn');
      if (status === 'approved food request') {
        deliverButton.classList.remove('d-none');
        deliverButton.style.display = 'inline-block';
      } else {
        deliverButton.classList.add('d-none');
      }
      deliverButton.addEventListener('click', deliverFoodRequest);

      const complainButton = document.getElementById('complain-food-request-btn');
      if (status === 'approved food request') {
        complainButton.classList.remove('d-none');
        complainButton.style.display = 'inline-block';
      } else {
        complainButton.classList.add('d-none');
      }

      complainButton.addEventListener('click', function () {
          let customerId = data.user_id;
          document.getElementById('customerID').value = customerId;
          $("#complain-modal").modal('show');
      });


      const banButton = document.getElementById('ban-food-request-btn');
      if (status === 'approved food request') {
        banButton.classList.remove('d-none');
        banButton.style.display = 'inline-block';
      } else {
        banButton.classList.add('d-none');
      }

      banButton.addEventListener('click', function () {
          let bannedCustomerID = data.user_id;
          document.getElementById('bannedCustomerID').value = bannedCustomerID;
          $("#banned-modal").modal('show');
      });

      const cancelButton = document.getElementById('cancel-food-request-btn');
      if (status != 'completed') {
        cancelButton.classList.remove('d-none');
        cancelButton.style.display = 'inline-block';
      } else {
        cancelButton.classList.add('d-none');
      }
      cancelButton.addEventListener('click', cancelFoodRequest);


      let foodImagesContainer = document.getElementById('food-images-container');
      foodImagesContainer.innerHTML = ''; 

      foodImages.forEach(image => {
          let imgElement = document.createElement('img');
          imgElement.src = `/upload/food/multiple/${image.image}`; 
          imgElement.style.width = '150px';
          imgElement.style.height = '100px';
          imgElement.style.marginRight = '10px'; 
          foodImagesContainer.appendChild(imgElement);
      });

      let food_upload_tnc_status = data.food['accept_tnc'];
      let tncText = food_upload_tnc_status === 0 ? 'Not Accepted' : 'Accepted';
      let tncClass = food_upload_tnc_status === 0 ? 'bg-danger' : 'bg-success';
      document.getElementById('food-upload-tnc').innerHTML = `<span class="badge ${tncClass}">${tncText}</span>`;

      let accept_order_request_tnc_status = data['accept_order_request_tnc'];
      let tncOrderReqText = accept_order_request_tnc_status === 0 ? 'Not Accepted' : 'Accepted';
      let tncOrderReqClass = accept_order_request_tnc_status === 0 ? 'bg-danger' : 'bg-success';
      document.getElementById('food-order-request-tnc').innerHTML = `<span class="badge ${tncOrderReqClass}">${tncOrderReqText}</span>`;

      let accept_food_deliver_tnc_status = data['accept_food_deliver_tnc'];
      let tncFoodDelText = accept_food_deliver_tnc_status === 0 ? 'Not Accepted' : 'Accepted';
      let tncFoodDelClass = accept_food_deliver_tnc_status === 0 ? 'bg-danger' : 'bg-success';
      document.getElementById('food-delivery-tnc').innerHTML = `<span class="badge ${tncFoodDelClass}">${tncFoodDelText}</span>`;

      document.getElementById('accept-tnc-row').innerHTML = '';
      let acceptTncRow = document.createElement('tr');
      if (status === 'pending') {
        acceptTncRow.innerHTML = `
          <th><strong>Accept T&C For Request Approve :</strong></th>
          <td>
            <div class="col-lg-12">
              <div class="form-group">
                <input type="checkbox" class="form-check-input" id="accept_tnc" onchange="handleCheckboxChange()">
                <label class="form-check-label" for="defaultCheck3"><a href="/client/terms-conditions/request_approve" target="_blank">Accept T&C For Request Approve</a></label>
                <span class="text-danger">*</span>
                <span class="error-message text-danger" id="accept_tnc-error"></span>
              </div>
            </div>
          </td>
        `;
      } else if (status === 'approved food request') {
        acceptTncRow.innerHTML = `
          <th><strong>Accept T&C For Food Deliver :</strong></th>
          <td>
            <div class="col-lg-12">
              <div class="form-group">
                <input type="checkbox" class="form-check-input" id="accept_tnc" onchange="handleCheckboxChange()">
                <label class="form-check-label" for="defaultCheck3"><a href="/client/terms-conditions/food_deliver" target="_blank">Accept T&C For Food Deliver</a></label>
                <span class="tx-danger">*</span>
                <span class="error-message text-danger" id="accept_tnc-error"></span>
              </div>
            </div>
          </td>
        `;
      }

      document.getElementById('accept-tnc-row').appendChild(acceptTncRow);

        // Initialize the map with user's location
        const map = L.map('customerLocation').setView([data.user.latitude, data.user.longitude], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a marker for the address
        L.marker([data.user.latitude, data.user.longitude]).addTo(map)
            .bindPopup(`<b>${data.user.address}</b>`)
            .openPopup();

      let tableList1 = $("#tableList1");
      tableList1.empty();

      let orderDate = data.order_date === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.order_date}</span>`;

      let orderTime = data.order_time === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.order_time}</span>`;

      let approveDate = data.approve_date === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.approve_date}</span>`;

      let approveTime = data.approve_time === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.approve_time}</span>`;

      let deliveryDate = data.delivery_date === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.delivery_date}</span>`;

      let deliveryTime = data.delivery_time === null ? 
          '<span class="badge bg-danger">Pending</span>' : 
          `<span class="badge bg-info">${data.delivery_time}</span>`;

      let row1 = `<tr>
          <td>${orderDate}</td>
          <td>${orderTime}</td>
          <td>${approveDate}</td>
          <td>${approveTime}</td>
          <td>${deliveryDate}</td>
          <td>${deliveryTime}</td>
      </tr>`;

      tableList1.append(row1);

    } catch (error) {
      console.error('Error fetching food information:', error);
    }finally{
      hideLoader();      
    }
  }


  function formatTime(timeString) {
      let date = new Date('1970-01-01T' + timeString + 'Z');
      let hours = date.getUTCHours();
      let minutes = date.getUTCMinutes();
      let seconds = date.getUTCSeconds();

      let amPm = hours >= 12 ? 'PM' : 'AM';

      hours = hours % 12;
      hours = hours ? hours : 12;

      minutes = minutes < 10 ? '0' + minutes : minutes;
      seconds = seconds < 10 ? '0' + seconds : seconds;

      return `${hours}:${minutes}:${seconds} ${amPm}`;
  }


  function handleCheckboxChange(event) {
    const checkbox = event.target;
    checkbox.checked = !checkbox.checked; 
  }
  
  
  async function approveFoodRequest(event) {
    event.preventDefault();
    let accept_tnc = document.getElementById('accept_tnc').checked ? 1 : 0;
    let id = document.getElementById('orderID').value;

    if (!accept_tnc) {
      errorToast("You must accept the terms and conditions!");
      return;
    }

    try {
      let res = await axios.post("/client/approve/food/request", { id: id, accept_tnc: accept_tnc });
      if (res.status === 200) {
        successToast(res.data.message || "Food request approved successfully.");
        window.location.href = '/client/order/list';
      } else {
        errorToast("Request failed");
      }
    } catch (error) {
      handleRequestError(error);
    }
  }

  async function deliverFoodRequest(event) {
    event.preventDefault();
    let accept_tnc = document.getElementById('accept_tnc').checked ? 1 : 0;
    let id = document.getElementById('orderID').value;

    if (!accept_tnc) {
      errorToast("You must accept the terms and conditions!");
      return;
    }
    
    try {
      let res = await axios.post("/client/delivered/food/request", { id: id, accept_tnc: accept_tnc });
      if (res.status === 200) {
        successToast(res.data.message || "Food delivered successfully");
        window.location.href = '/client/order/list';
      } else {
        errorToast("Request failed");
      }
    } catch (error) {
      handleRequestError(error);
    }
  }

  async function cancelFoodRequest(event) {
    event.preventDefault();
    let id = document.getElementById('orderID').value;
    try {
      let res = await axios.post("/client/cancel/food/request", { id: id });
      if (res.status === 200) {
        successToast(res.data.message || "Food request canceled successfully");
        window.location.href = '/client/order/list';
      } else {
        errorToast("Request failed");
      }
    } catch (error) {
      handleRequestError(error);
    }
  }

  function handleRequestError(error) {
    if (error.response) {
      errorToast(error.response.data.message || "An error occurred while processing the request.");
    } else {
      errorToast("Something went wrong. Please try again.");
    }
  }

</script>


