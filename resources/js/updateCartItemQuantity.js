/**
 * Update the passed in cart items quantity
 * @function userCartItem
 * @param CartItem::class userCartItem
 * @returns json describing a cart item from the user
 * 
 * @function updateCartItemQuantity
 * @param String action
 * Doesn't return anything, just updates the cart items quantity
 */

function userCartItem(userCartItem) {

    return {

        id: userCartItem.id,
        quantity: userCartItem.quantity,

        updateCartItemQuantity(action) {
        
            console.log(`Made it inside updateCartItemQuantity -- action: ${action}`);
        
            let route = (action === 'increment') ? '/cart/increment-quantity' : '/cart/decrement-quantity';
        
            fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ userCartItem: this.id })
            }).then(res => res.json())
              .then(data => {
                // Select dom element that has the quantity displayed in the navbar
                // then set its content to be data.quantity
                let cartTotalQuantity = document.getElementById('cartTotalQuantity');
                cartTotalQuantity.innerHTML = data.quantity;
        
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
              });
        }
    }
}


export default userCartItem;