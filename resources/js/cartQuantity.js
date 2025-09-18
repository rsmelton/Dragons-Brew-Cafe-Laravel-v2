function cartQuantityComponent() {
    return {
        quantity: 0,

        loadQuantity() {
            fetch('/cart/quantity')
                .then(res => res.json())
                .then(data => {
                    this.quantity = data.quantity;
                });
        },

        updateQuantityFromResponse(data) {
            if (data?.quantity !== undefined) {
                this.quantity = data.quantity;
            }
        }
    };
}

// function cartActions() {

// }