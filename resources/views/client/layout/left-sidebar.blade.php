<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ url('/client/dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
          <img id="logo" src="/upload/no_image.jpg" width="100" height="50" alt="App Logo">
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
          fill="currentColor"
          fill-opacity="0.6" />
        <path
          d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
          fill="currentColor"
          fill-opacity="0.38" />
      </svg>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item">
      <a href="{{ url('/client/dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
        <div data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.brands') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-watermark"></i>
        <div data-i18n="Brand">Brand</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.coupons') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-ticket-percent-outline"></i>
        <div data-i18n="Coupon">Coupon</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.products') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-food"></i>
        <div data-i18n="Sparex">Sparex</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.orders') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
        <div data-i18n="Orders">Orders</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.customers') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-account-group-outline"></i>
        <div data-i18n="Customers">Customers</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.ban-customers') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-account-cancel-outline"></i>
        <div data-i18n="Banned Customers">Banned Customers</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('client.followers') }}" class="menu-link">
        <i class="menu-icon mdi mdi-alpha-f-box-outline"></i>
        <div data-i18n="Followers">Followers</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-asterisk"></i>
        <div data-i18n="Complaints">Complaints</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('client.complains') }}" class="menu-link">
            <div data-i18n="Item Complaints">Item Complaints</div>
          </a>
        </li>

        <li class="menu-item">
          <a href="{{ route('client.customer-complains') }}" class="menu-link">
            <div data-i18n="Customer Complaints">Customer Complaints</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- Components -->
    <li class="menu-header fw-medium mt-4">
      <span class="menu-header-text" data-i18n="Reports">Reports</span>
    </li>
    <!-- Cards -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-credit-card-outline"></i>
        <div data-i18n="Reports">Reports</div>
        <div class="badge bg-primary rounded-pill ms-auto">2</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('client.todays.report') }}" class="menu-link">
            <div data-i18n="Todays Report">Todays Report</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('client.search.report') }}" class="menu-link">
            <div data-i18n="Search Report">Search Report</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</aside>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        settingInfo(); 
    });

    async function settingInfo() {
      showLoader();
      try {
          const response = await axios.get('/setting-list');

          if (response.status === 200) {
              const data = response.data.data;
              document.getElementById('logo').src = data['logo'] ? "/upload/site-setting/" + data['logo'] : "/upload/no_image.jpg";
          }
      } catch (error) {
          handleError(error);
      }finally{
          hideLoader();
      }
    }


    function handleError(error) {
      if (error.response) {
          const status = error.response.status;
          const message = error.response.data.message || 'An unexpected error occurred';
          if (status === 500) {
              errorToast(message || 'Server Error');
          } else {
              errorToast(message);
          }
      } else {
          errorToast('No response received from the server.');
      }
    }
</script>