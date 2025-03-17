function showLoader() {
    document.getElementById('bouncing-loader').style.display = 'flex';
}
function hideLoader() {
    document.getElementById('bouncing-loader').style.display = 'none';  
}

function successToast(msg) {
    Toastify({
        gravity: "top", 
        position: "right",
        text: msg,
        className: "mb-5",
        style: {
            background: "green",
        }
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        gravity: "top", 
        position: "right",
        text: msg,
        className: "mb-5",
        style: {
            background: "red",
        }
    }).showToast();
}

function isTokenValid() {
    const token = getCookie('token');

    if (!token) {
        return false;
    }

    const decodedToken = decodeJwt(token);
    if (decodedToken && decodedToken.exp) {
        const currentTime = Math.floor(Date.now() / 1000); 
        if (decodedToken.exp < currentTime) {
            return false; 
        }
    }

    if (!verifyTokenWithServer(token)) {
        return false;
    }

    return true;
}

function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim(); 
        if (cookie.startsWith(name + '=')) {
            return cookie.substring((name + '=').length);
        }
    }
    return null;
}

function decodeJwt(token) {
    try {
        const payload = token.split('.')[1];
        return JSON.parse(atob(payload));
    } catch (error) {
        return null;
    }
}

function verifyTokenWithServer(token) {
    const isValid = fetch('/verify-token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`,
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'unauthorized') {
            return false; 
        }
        return true;
    })
    .catch(() => {
        return false; 
    });

    return isValid;
}

// Add these functions to your config.js
async function updateCartCount() {
    try {
        const response = await axios.get('/user/cart/count', {
            headers: {
                'Authorization': 'Bearer ' + getCookie('token')
            }
        });
        
        if (response.data.status === 'success') {
            const count = response.data.count;
            const cartCountElem = document.getElementById('cartCount');
            const cartItemElem = document.getElementById('cartItem');
            
            if (count > 0) {
                cartCountElem.textContent = count;
                cartItemElem.style.display = 'block';
            } else {
                cartItemElem.style.display = 'none';
            }
        }
    } catch (error) {
        console.error('Cart count update failed:', error);
    }
}

function setupCartEventListeners() {
    // Listen for quantity changes
    document.addEventListener('input', async (e) => {
        if (e.target.matches('.cart-quantity-input')) {
            const cartId = e.target.dataset.cartId;
            const newQuantity = e.target.value;
            
            try {
                await axios.post('/user/cart/update', {
                    cart_id: cartId,
                    quantity: newQuantity
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('token')
                    }
                });
                
                document.dispatchEvent(new Event('cartUpdated'));
                successToast('Quantity updated');
            } catch (error) {
                errorToast('Failed to update quantity');
            }
        }
    });

    // Listen for remove item clicks
    document.addEventListener('click', async (e) => {
        if (e.target.matches('.remove-cart-item')) {
            const cartId = e.target.dataset.cartId;
            
            try {
                await axios.post('/user/cart/remove', {
                    cart_id: cartId
                }, {
                    headers: {
                        'Authorization': 'Bearer ' + getCookie('token')
                    }
                });
                
                document.dispatchEvent(new Event('cartUpdated'));
                successToast('Item removed from cart');
            } catch (error) {
                errorToast('Failed to remove item');
            }
        }
    });
}


