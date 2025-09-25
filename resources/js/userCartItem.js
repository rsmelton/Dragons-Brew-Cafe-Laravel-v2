export default function userCartItem(item) {
    return {
        id: item.id,
        quantity: item.quantity,

        incrementQuantity() {
            fetch(`/cart/${this.id}/increment`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                this.quantity = data.quantity;

                // Update global cart store
                Alpine.store('cart').setQuantity(data.totalQuantity);

                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            });
        },

        decrementQuantity() {
            fetch(`/cart/${this.id}/decrement`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                this.quantity = data.quantity;

                Alpine.store('cart').setQuantity(data.totalQuantity);

                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            });
        }
    }
}
