import Alpine from 'alpinejs';

Alpine.store('cart', {
    cartItems: [],
    cartTotalPrice: 0,
    cartTotalQuantity: 0,

    // Instead of keeping track of the quantity, we can make a helper method
    // that finds the total quantity. We just have to remember to go back
    // to the header file and replace .quantity with the helper method

    // Which means in every method we just need to update the cartItems list
    // instead of the quantity and that will allow for reactive display on the frontend

    // Going to have to update each method to also update the cartItems field,
    // which means inside each controller we will also have to return the cart
    // after making the change

    // This method gets passed the users cart items from the view
    // and the view gets these initial cart items from the index method
    // inside the cart controller.
    async updateCart() {
        try {
            let response = await fetch('/cart/update');

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            this.cartItems = data.cartItems;
            this.cartTotalPrice = data.cartTotalPrice;
            this.cartTotalQuantity = data.cartTotalQuantity;

        } catch (error) {
            console.error("Error when updating the cart:", error);
        }
    },

    async addToCart(menuItemId, quantityToAdd) {
        try {
            let response = await fetch("/cart", {
                method: "POST",
                headers: {
                    "Content-Type" : "application/json",
                    "X-CSRF-TOKEN" : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ menuItemId: menuItemId, quantityToAdd: quantityToAdd })
            });

            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            let data = await response.json();
            console.log(data);

            this.cartItems = data.cartItems;
            this.cartTotalPrice = data.cartTotalPrice;
            this.cartTotalQuantity = data.cartTotalQuantity;
            
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
            console.log(data);

            this.cartItems = data.cartItems;
            this.cartTotalPrice = data.cartTotalPrice;
            this.cartTotalQuantity = data.cartTotalQuantity;

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
            console.log(data);

            this.cartItems = data.cartItems;
            this.cartTotalPrice = data.cartTotalPrice;
            this.cartTotalQuantity = data.cartTotalQuantity;

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
            console.log(data);

            this.cartItems = data.cartItems;
            this.cartTotalPrice = data.cartTotalPrice;
            this.cartTotalQuantity = data.cartTotalQuantity;

        } catch (error) {
            console.error("Error when decrementing a cart item:", error);
        }
    }
});