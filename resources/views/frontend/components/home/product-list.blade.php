<section id="landingFeatures" class="section-py landing-features">
    <div class="container">               
        <div class="app-academy"> 
            <div class="card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                        <h5 class="mb-1">Item List</h5>
                        <p class="mb-0" id='item-count'>Total 0 items found</p>
                    </div>
                    <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                        <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                            <input type="search" id="search-field" name="search-field" placeholder="Find sparex items" class="form-control me-2" />
                            <div id="search-error" class="text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 mb-4" id="product-list"></div>
                    <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                        <ul class="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let debounceTimeout;
    let userLatitude, userLongitude;

    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                userLatitude = position.coords.latitude;
                userLongitude = position.coords.longitude;
                ProductList(1, null, userLatitude, userLongitude); 
            }, error => {
                console.error("Location access denied or error", error);
                ProductList(); 
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
            ProductList(); 
        }
    }

    async function ProductList(page = 1, searchQuery = null, latitude = null, longitude = null) {
        showLoader();
        try {
            let url = `/product-list?page=${page}`;

            if (searchQuery) {
                  url = `/search-product?page=${page}&query=${encodeURIComponent(searchQuery)}`;
            } else if (latitude && longitude) {
                url += `&latitude=${latitude}&longitude=${longitude}`;
            }

            const res = await axios.get(url);
            const data = res.data;
            //console.log('----------------',res);
            const paginationContainer = document.querySelector('.pagination');

            if (data.status === 'success') {
                const productData = data.products.data || [];
                const totalProducts = data.total;
                updateProductList(productData);
                updateTotalCount(totalProducts); 

                if (totalProducts === 0) {
                    paginationContainer.innerHTML = ''; 
                } else if (!searchQuery) {
                    updatePagination(data.products);
                }
            } else if (data.status === 'failed') {
                paginationContainer.innerHTML = ''; 
            }

            document.getElementById('product-list').scrollIntoView({ behavior: 'smooth' });

        } catch (error) {
            handleError(error);
        } finally {
            hideLoader();
        }
    }

    function updateProductList(productList, productData = null) {
        const gridViewContainer = document.getElementById('product-list');
        // If foodData is passed, update the food item's follow status
        if (productData) {
            const { userId, isFollowing } = productData;
            productList.forEach(product => {
                if (product.client_id === userId) {
                    product.isFollowing = isFollowing; // Update the food item's follow status
                }
            });
        }

        gridViewContainer.innerHTML = productList.map(product => {
            const isProcessing = product.status === "processing";
            const disabledStyle = isProcessing ? 'style="pointer-events: none; opacity: 0.5;"' : '';
            const productName = product.name;
            const clientFirstName = product.client.firstName;
            const clientLastName = product.client.lastName;
            const fullName = clientLastName ? `${clientFirstName} ${clientLastName}` : clientFirstName;
            const requestBadge = isProcessing ? `<span class="btn btn-danger">under request</span>` : '';
            const collectionAddress = !isProcessing ? `<span style='color:green'><strong>Collection Address:</strong></span>` : '';
            const productAddress = !isProcessing ? `<span><i class="mdi mdi-map-marker me-2"></i>${product.address1}</span>` : requestBadge;
            const followText = product.isFollowing ? 'UNFOLLOW' : 'FOLLOW';
            const followClass = product.isFollowing ? 'bg-danger' : 'bg-info';
            
            // Update the product template in updateProductList function
            return `
            <div class="col-sm-6 col-lg-4" ${disabledStyle}>
                <div class="card p-2 h-100 shadow-none border">
                    <div class="rounded-2 text-center mb-3">
                        <a href="/product-details/${product.id}" ${disabledStyle}>
                            <img class="img-fluid" src="/upload/product/medium/${product.image}" alt="${productName}">
                        </a>
                    </div>
                    <div class="card-body p-3 pt-2">
                        <a href="/product-details/${product.id}" class="h5" ${disabledStyle}>${productName}</a>
                        
                        <div class="price-info mt-2">
                            <span class="me-1 text-dark">Price: </span>
                            ${product.is_free === 1 ? 
                                '<span class="text-success fw-bold ms-1">Free</span>' :
                                product.has_discount_price === 1 ?
                                    `<del class="text-muted me-2">$${product.price}</del>
                                     <span class="text-success fw-bold">$${product.discount_price}</span>` :
                                    `<span class="fw-bold ms-1">$${product.price}</span>`
                            }
                        </div>

                        <p class="d-flex align-items-center mt-2">
                            <span class="me-1 text-dark">Donator:</span> ${fullName}
                            <a id="follow-btn-${product.client_id}" class="ms-2 badge ${followClass} align-items-center" href="javascript:void(0);" onclick="toggleFollow(${product.client_id})">
                                <i class="mdi mdi-follow align-middle me-1"></i><span>${followText}</span>
                            </a>
                        </p>
                        <p class="d-flex align-items-center">${productAddress}</p>
                        <div class="progress rounded-pill mb-4" style="height: 8px">
                            <div class="progress-bar" style="width: ${product.progress}%" role="progressbar" aria-valuenow="${product.progress}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-3 text-nowrap flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                            <a class="w-100 p-2 btn btn-outline-success d-flex align-items-center" href="javascript:void(0);" onclick="addToWishlist(${product.id})">
                                <i class="mdi mdi-heart align-middle me-1"></i><span>Wishlist</span>
                            </a>

                            <a class="w-100 p-2 btn btn-outline-primary d-flex align-items-center" href="/product-details/${product.id}" ${disabledStyle}>
                                <span class="me-1">Continue</span><i class="mdi mdi-arrow-right lh-1 scaleX-n1-rtl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            `;
        }).join('');
    }

    function loadPage(event, url) {
        event.preventDefault(); 
        const page = new URL(url).searchParams.get('page'); 
        ProductList(page, null, userLatitude, userLongitude); 
    }

    function updatePagination(paginationData) {
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = ''; 

        paginationData.links.forEach(link => {
            if (link.active) {
                paginationContainer.innerHTML += `
                <li class="page-item active">
                <a class="page-link" href="javascript:void(0);">${link.label}</a>
                </li>`;
            } else if (link.url) {
                paginationContainer.innerHTML += `
                <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="loadPage(event, '${link.url}')">${link.label}</a>
                </li>`;
            } else {
                paginationContainer.innerHTML += `
                <li class="page-item disabled">
                <span class="page-link">${link.label}</span>
                </li>`;
            }
        });
    }

    function updateTotalCount(totalProducts) {
        const totalItemsElement = document.querySelector('.card-title p.mb-0');

        if (totalProducts > 0) {
            totalItemsElement.innerHTML = `Total ${totalProducts} items found`;
            totalItemsElement.classList.remove('text-danger'); 
            totalItemsElement.classList.add('text-success'); 
        } else {
            totalItemsElement.innerHTML = `No items found`;
            totalItemsElement.classList.remove('text-success'); 
            totalItemsElement.classList.add('text-danger'); 
        }
    }

    function handleError(error) {
        displaySearchError("An unexpected error occurred. Please try again.");
    }

    async function toggleFollow(clientId) {
        try {
            const res = await axios.post('/user/store/follower-request', {
                client_id: clientId
            });

            if (res.status === 200 && res.data.status === 'success') {
                const newStatus = res.data.isFollowing; 
                const followButtons = document.querySelectorAll(`#follow-btn-${clientId}`);
                
                followButtons.forEach(button => {
                    if (newStatus) {
                        button.innerHTML = `<i class="mdi mdi-follow align-middle me-1"></i><span>UNFOLLOW</span>`;
                        button.classList.remove("bg-info");
                        button.classList.add("bg-danger");
                    } else {
                        button.innerHTML = `<i class="mdi mdi-follow align-middle me-1"></i><span>FOLLOW</span>`;
                        button.classList.remove("bg-danger");
                        button.classList.add("bg-info");
                    }
                });

                const productData = { clientId, is_following: newStatus };
                updateProductList(productData);
            } else {
                errorToast(res.data.message || "Failed to toggle follow status");
            }
        } catch (error) {
            if (error.response) {
                if (error.response.status === 401) {
                    window.location.href = '/user/login'; 
                } else {
                    errorToast(error.response.data.message || "An unexpected error occurred.");
                }
            } else {
                //errorToast("An unexpected error occurred2.");
            }
        }
    }

    async function addToWishlist(productId) {
        try {
            const res = await axios.post('/user/store/wishlist-request', { id: productId });
            if (res.status === 201) {
                successToast(res.data.message || 'Request success');
                await ProductList();
                await updateWishlistCount();
            } else {
                errorToast(res.data.message || "Request failed");
            }
        } catch (error) {
            if (error.response) {
                if (error.response.status === 401) {
                    window.location.href = '/user/login';
                } else if (error.response.status === 422) {
                    errorToast(error.response.data.message || "Validation failed.");
                } else if (error.response.status === 409) {
                    errorToast(error.response.data.message || "This item is already in your wishlist.");
                } else if (error.response.status === 403) {
                    errorToast(error.response.data.message || "Your limit to add wishlist is over");
                } else if (error.response.status === 500) {
                    errorToast(error.response.data.error || "An internal server error occurred.");
                } else {
                    errorToast(error.response.data.message || "An error occurred.");
                }
            } else {
                errorToast("An unexpected error occurred.");
                console.error('Error adding to wishlist:', error);
            }
        }
    }

    const debouncedSearch = debounce(function() {
        const searchQuery = document.querySelector('input[name="search-field"]').value || null;
        ProductList(1, searchQuery, userLatitude, userLongitude);
    }, 500);

    document.getElementById('search-field').addEventListener('input', debouncedSearch);
    window.onload = getUserLocation; 
</script>

