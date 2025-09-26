import Alpine from 'alpinejs';

Alpine.store('cart', {
    cartItems: [],
    cartTotalPrice: 0,
    cartTotalQuantity: 0,

    // This method is for displaying the initial cart total quantity in the users cart in the header
    async getInitialCartTotalQuantity() {
        try {
            let response = await fetch('/cart/total-quantity');

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.cartTotalQuantity = data.cartTotalQuantity;

        } catch (error) {
            console.error("Error when updating the cart:", error);
        }
    },

    // This method is used to update the cart and allow for reactivity in the frontend
    async updateCart() {
        try {
            let response = await fetch('/cart/update');

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.updateCartFields(data);

        } catch (error) {
            console.error("Error when updating the cart:", error);
        }
    },

    async addToCart(menuItemId) {
        try {
            let response = await fetch("/cart", {
                method: "POST",
                headers: {
                    "Content-Type" : "application/json",
                    "X-CSRF-TOKEN" : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ menuItemId: menuItemId })
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.updateCartFields(data);

        } catch (error) {
            console.error("Error when adding item to cart:", error);
        }
    },

    async deleteFromCart(userCartItemId) {
        try {
            let response = await fetch(`/cart/${userCartItemId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type" : "application/json",
                    "X-CSRF-TOKEN" : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.updateCartFields(data);

        } catch (error) {
            console.error("Error when deleting item from cart:", error);
        }
    },

    async incrementQuantity(userCartItemId) {
        try {
            let response = await fetch(`/cart/${userCartItemId}/increment-quantity`, {
                method: "PATCH",
                headers: {
                    "Content-Type" : "application/json",
                    "X-CSRF-TOKEN" : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.updateCartFields(data);

        } catch (error) {
            console.error("Error when incrementing a cart item:", error);
        }
    },

    async decrementQuantity(userCartItemId) {
        try {
            let response = await fetch(`/cart/${userCartItemId}/decrement-quantity`, {
                method: "PATCH",
                headers: {
                    "Content-Type" : "application/json",
                    "X-CSRF-TOKEN" : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.updateCartFields(data);

        } catch (error) {
            console.error("Error when decrementing a cart item:", error);
        }
    },

    updateCartFields(data) {
        this.cartItems = data.cartItems;
        this.cartTotalPrice = data.cartTotalPrice;
        this.cartTotalQuantity = data.cartTotalQuantity;
    }
});