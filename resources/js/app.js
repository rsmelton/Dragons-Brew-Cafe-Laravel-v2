import './bootstrap';

import Alpine from 'alpinejs';
import updateCartItemQuantity from './updateCartItemQuantity';

window.Alpine = Alpine;
window.updateCartItemQuantity = updateCartItemQuantity;

Alpine.start();
