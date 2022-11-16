"use strict"

const URL = "api/products/";

let products = [];

let form = document.querySelector('#product-form');
form.addEventListener('submit', insertProduct);


/**
 * Obtiene todas los productos de la API REST
 */
async function getAll() {
    try {
        let response = await fetch(URL);
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }
        products = await response.json();

        showProducts();
    } catch(e) {
        console.log(e);
    }
}

/**
 * Inserta un producto via API REST
 */
async function insertProduct(e) {
    e.preventDefault();
    
    let data = new FormData(form);
    let product = {
        nombre_producto: data.get('nombre_producto'),
        precio: data.get('precio'),
        id_variedad: data.get('id_variedad'),
    };

    try {
        let response = await fetch(URL, {
            method: "POST",
            headers: { 'Content-Type': 'application/json'},
            body: JSON.stringify(product)
        });
        if (!response.ok) {
            throw new Error('Error del servidor');
        }

        let nProduct = await response.json();

        // inserto la tarea nuevo
        products.push(nProduct);
        showProducts();

        form.reset();
    } catch(e) {
        console.log(e);
    }
} 

async function deleteProduct(e) {
    e.preventDefault();
    try {
        let id = e.target.dataset.product;
        let response = await fetch(URL + id, {method: 'DELETE'});
        if (!response.ok) {
            throw new Error('Recurso no existe');
        }

        // eliminar la tarea del arreglo global
        products = products.filter(producto => producto.id != id);
        showProducts();
    } catch(e) {
        console.log(e);
    }
}

function showProducts() {
    let ul = document.querySelector("#product-list");
    ul.innerHTML = "";

    // asigno event listener para los botones
    const btnsDelete = document.querySelectorAll('a.btn-delete');
    for (const btnDelete of btnsDelete) {
        btnDelete.addEventListener('click', deleteProduct);
    }
}

getAll();