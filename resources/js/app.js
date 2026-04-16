import './bootstrap';
import axios from 'axios';
import Alpine from 'alpinejs';

// Create a global reactive store
Alpine.store('cart', {
    count: 0,
    showToast: false,
    itemName: '',

    // Initialize with data from the server/session
    init() {
        // We will set this via a hidden input or global var in the blade
    },

    update(data) {
        this.count = data.cartCount;
        this.itemName = data.itemName;
        this.showToast = true;
        setTimeout(() => { this.showToast = false; }, 5000);
    }
});

window.Alpine = Alpine;
Alpine.start();

// Global Add to Cart function
window.addToCart = function(productId) {
    return axios.post(`/cart/add/${productId}`, {})
        .then(response => {
            Alpine.store('cart').update(response.data);
            return response.data;
        })
        .catch(error => console.error('Logistics Error:', error));
};

// Global Update Quantity (+/-)
window.updateCartQty = function(productId, action) {
    return axios.post('/cart/update-qty', { id: productId, action: action })
        .then(response => {
            // Update store without showing the "Added" toast
            Alpine.store('cart').count = response.data.cartCount;
            // Dispatch event for components listening for full cart data
            window.dispatchEvent(new CustomEvent('cart-updated', { detail: response.data }));
            return response.data;
        })
        .catch(error => console.error('Adjustment Error:', error));
};