import './bootstrap';
import axios from 'axios';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

window.addToCart = function(productId) {
    return axios.post(`/cart/add/${productId}`, {})
        .then(response => {
            // Update global badge
            const badge = document.getElementById('cart-count-badge');
            if(badge) badge.innerText = response.data.cartCount;
            
            // Dispatch event so the layout sidebar can hear it
            window.dispatchEvent(new CustomEvent('cart-updated', { 
                detail: { 
                    cart: response.data.cart,
                    total: response.data.total
                } 
            }));
            
            return response.data;
        })
        .catch(error => {
            console.error('Deployment Error:', error);
            alert('Could not add unit to deployment.');
        });
}