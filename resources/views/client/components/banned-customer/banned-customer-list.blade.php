<div class="card">
    <div class="card-header header-elements">
        <span class="me-2"><h5>Banned Customer List</h5></span>
    </div>

    <div class="card-datatable table-responsive pt-0">
        <table id="foodTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Customer Name</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Time</th>
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
            let res = await axios.get("/client/ban-customer-info");

            let tableList = $("#tableList");
            tableList.empty(); 

            res.data.data.forEach(function (item, index) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(item['message'], 'text/html');
                let fullMessage = doc.body.innerHTML;

                let createdAt = new Date(item['created_at']);
                let complainDate = createdAt.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                let complainTime = createdAt.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });


                let customerName = item.customer 
                    ? `${item.customer.firstName} ${item.customer.lastNname || ''}`.trim()
                    : 'Unknown Customer';

                let row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${customerName}</td>
                        <td>${fullMessage}</td>
                        <td>${complainDate}</td>
                        <td>${complainTime}</td>
                        <td>
                            <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">
                                <span class="mdi mdi-trash-can-outline"></span>
                            </button>
                        </td>
                    </tr>`;
                tableList.append(row);
            });

            initializeDataTable();
            attachEventListeners();

        } catch (error) {
            handleError(error);
        } finally {
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
</script>

