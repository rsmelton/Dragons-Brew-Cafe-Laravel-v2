import './bootstrap';

import Alpine from 'alpinejs';
import userCartItem from './userCartItem';

Alpine.data('userCartItem', userCartItem);

Alpine.store('cart', {
    quantity: 0,
    setQuantity(qty) {
        this.quantity = qty;
    },
    increment() {
        this.quantity++;
    },
    decrement() {
        this.quantity = Math.max(this.quantity - 1, 0);
    }
});

window.Alpine = Alpine;

Alpine.start();
