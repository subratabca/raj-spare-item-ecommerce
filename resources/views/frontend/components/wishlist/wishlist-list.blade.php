@extends('frontend.components.dashboard.dashboard-master')
@section('dashboard-content')

<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Wishlist Information</h5></span>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Provider Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">
                
            </tbody>
        </table>
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
            let res = await axios.get("/user/wishlist-info");

            let tableList = $("#tableList");
            tableList.empty(); 

            res.data.data.forEach(function (item, index) {
                let formattedDate = formatDate(item.created_at);
                let formattedTime = formatTime(item.created_at);

                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.food.image ? 
                        `<img src="/upload/food/small/${item.food.image}" width="50" height="50">` : 
                        `<img src="/upload/no_image.jpg" width="50" height="50">`}
                        </td>
                        <td>${item.food.name}</td>
                        <td>${item.food.user.firstName}</td>
                        <td>
                            <span class="badge ${item.food.status === 'pending' ? 'bg-danger' : 'bg-success'}">
                            ${item.food.status}
                            </span>
                        </td>

                        <td>
                            ${(item.food.status === 'published') ? 
                            `<a href="/food-details/${item['food']['id']}" class="btn btn-sm btn-outline-success"><span class="mdi mdi-eye-circle"></span></a>` : ''}

                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><span class="mdi mdi-trash-can-outline"></span></button>
                        </td>
                    </tr>`;
                tableList.append(row);
            });

            initializeDataTable();
            attachEventListeners();

        } catch (error) {
            handleError(error);
        }finally {
            hideLoader();
        }
    }

    function initializeDataTable() {
        if ($.fn.DataTable.isDataTable('#foodTable')) {
            $('#foodTable').DataTable().destroy();
        }

        $('#foodTable').DataTable({
            "paging": true,
            "serverSide": false, 
            "autoWidth": false,
            "ordering": true,
            "searching": true, 
            "lengthMenu": [10, 25, 50, 100], 
            "pageLength": 10, 
        });
    }


    function attachEventListeners() {
        $('.deleteBtn').on('click', function () {
            let id = $(this).data('id');
            $("#deleteID").val(id);
            $("#delete-modal").modal('show');
        });
    }

    
    function formatDate(dateString) {
        let date = new Date(dateString);
        let months = ["January", "February", "March", "April", "May", "June",
                      "July", "August", "September", "October", "November", "December"];

        let day = date.getUTCDate();
        let month = months[date.getUTCMonth()];
        let year = date.getUTCFullYear();

        return `${day} ${month} ${year}`;
    }

    function formatTime(dateString) {
        let date = new Date(dateString);
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

