let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

menu.onclick = () =>{
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
};

window.onscroll = () =>{
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
};


document.querySelector('#close-edit').onclick = () =>{
   document.querySelector('.edit-form-container').style.display = 'none';
   window.location.href = 'admin.php';
};

document.addEventListener('DOMContentLoaded', () => {
   fetchCartItems();

   document.getElementById('checkout').addEventListener('click', () => {
       alert('Proceeding to checkout...');
   });
});

function fetchCartItems() {
   fetch('cart.php')
       .then(response => response.json())
       .then(data => {
           const cartTableBody = document.querySelector('#cart tbody');
           cartTableBody.innerHTML = '';
           let total = 0;

           data.forEach(item => {
               const row = document.createElement('tr');
               row.innerHTML = `
                   <td>${item.product_name}</td>
                   <td><input type="number" value="${item.quantity}" data-id="${item.id}" class="quantity"></td>
                   <td>$${item.price}</td>
                   <td>$${(item.price * item.quantity).toFixed(2)}</td>
                   <td><button class="delete" data-id="${item.id}">Delete</button></td>
               `;
               cartTableBody.appendChild(row);
               total += item.price * item.quantity;
           });

           document.getElementById('total').textContent = total.toFixed(2);

           document.querySelectorAll('.delete').forEach(button => {
               button.addEventListener('click', deleteCartItem);
           });

           document.querySelectorAll('.quantity').forEach(input => {
               input.addEventListener('change', updateCartItem);
           });
       });
}

function deleteCartItem(event) {
   const id = event.target.getAttribute('data-id');
   fetch(`delete_cart_item.php?id=${id}`, { method: 'GET' })
       .then(() => fetchCartItems());
}

function updateCartItem(event) {
   const id = event.target.getAttribute('data-id');
   const quantity = event.target.value;
   fetch(`update_cart_item.php?id=${id}&quantity=${quantity}`, { method: 'GET' })
       .then(() => fetchCartItems());
}
