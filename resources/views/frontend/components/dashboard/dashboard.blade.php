@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <a href="{{ route('orders') }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-2">Total Orders</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-2 me-1 display-6" id="total-orders">0</h4>
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <div class="mdi mdi-account-search mdi-24px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <a href="{{ route('complains') }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-2">Total Complaints</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-2 me-1 display-6" id="total-complaints">0</h4>
                            </div>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <div class="mdi mdi-account-search mdi-24px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        getList();
    });

    async function getList() {
        showLoader();
        try {
            let res = await axios.get("/user/total/information");
            document.getElementById('total-orders').innerText = res.data.totalOrders;
            document.getElementById('total-complaints').innerText = res.data.totalComplaints;

        } catch (error) {
            handleError(error);
        }finally {
            hideLoader();
        }
    }


    function handleError(error) {
        if (error.response) {
            if (error.response.status === 500) {
                errorToast(error.response.data.error || "An internal server error occurred.");
            } else {
                errorToast("Request failed!");
            }
        } else {
            errorToast("Request failed!");
        }
    }

</script>

