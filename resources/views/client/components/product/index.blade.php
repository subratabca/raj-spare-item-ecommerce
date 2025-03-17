<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Product List</h5></span>
        <div class="card-header-elements ms-auto">
            <a href="/client/create/product" type="button" class="btn btn-primary waves-effect waves-light">
                <span class="tf-icon mdi mdi-plus me-1"></span>Add New Product
            </a>
        </div>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Type</th>
                    <th>Has Variant</th>
                    <th>Current Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableList">
                
            </tbody>
        </table>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        getList(); 
    });

    async function getList() {
        showLoader();
        try {
            let res = await axios.get("/client/index");

            let tableList = $("#tableList");
            tableList.empty(); 

            res.data.data.forEach(function (item, index) {

                let formattedExpireDate = formatDate(item['expire_date']);
                let formattedCollectionDate = formatDate(item['collection_date']);

                let formattedStartTime = formatTime(item['start_collection_time']);
                let formattedEndTime = formatTime(item['end_collection_time']);

                let isFree = item['is_free'] ? 'Free' : 'Paid';
                let hasVariants = item['has_variants'] ? 'View Variants' : 'No';

                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>
                        ${item['image'] ? `<img src="/upload/product/small/${item['image']}" width="50" height="50">` : `<img src="/upload/no_image.jpg" width="50" height="50">`}
                        </td>
                        <td>${item['name']}</td>
                        <td>${isFree}</td>
                        <td>${hasVariants}</td>
                        <td>${item['current_stock']}</td>
                        <td>
                            <span class="badge ${
                                item['status'] === 'pending' ? 'bg-danger' :
                                item['status'] === 'published' ? 'bg-primary' :
                                'bg-success'
                            }">
                            ${item['status']}
                            </span>
                        </td>
                        <td>
                            <a  href="/client/product/details/${item['id']}" class="btn btn-sm btn-outline-primary"><span class="mdi mdi-eye-circle"></span>
                            </a>

                            <a href="/client/edit/product/${item['id']}" class="btn btn-sm btn-outline-success"><span class="mdi mdi-pencil-outline"></span>
                            </a>

                            <a href="/client/edit/product/multi-image/${item['id']}" class="btn btn-sm btn-outline-info"><span class="mdi mdi-image-edit-outline"></span>
                            </a>

                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger"><span class="mdi mdi-trash-can-outline"></span></button>

                        </td>
                    </tr>`;
                    tableList.append(row);
                });
            initializeDataTable();
            attachEventListeners();

        } catch (error) {
            handleError(error);
        }finally{
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

    function formatDate(dateString) {
        let date = new Date(dateString);
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
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
</script>


