<div class="cart-status">
    <p>Your cart is {{ $cartIsEmpty ? 'empty' : 'not empty' }}; select a product to continue.</p>
</div>

<style>
.cart-status { padding: 1rem; border-top: 1px solid #ccc; text-align: center; }
</style>


{{-- Exemple d'utilisation :

blade
Copier le code
<x-cart-status :cartIsEmpty="true" /> --}}