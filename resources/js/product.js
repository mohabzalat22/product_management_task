import axios from 'axios';
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

const MAINURL = 'http://localhost:8000/api/v1';

const csrfToken = document.querySelector('meta[name="csrf-token"]').content;


function producthtml(id, name, price, quantity, description){
    return `<div class="bg-slate-200 rounded flex items-center justify-between p-2 max-w-[500px] mx-auto my-2">
        <div class="">
            <p class="text-gray-700 capitalize text-2xl">${name}</p>
        </div>
        <div>
            <button type="button" 
            data-product-id = "${id}"
            data-product-name = "${name}"
            data-product-price = "${price}"
            data-product-quantity = "${quantity}"
            data-product-description = "${description}"

            data-modal-target="product" data-modal-toggle="product" class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">edit</button>
            
            <button type="button" 
            data-product-id = "${id}"
            class="focus:outline-none text-white delete-btn w-full bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">delete</button>
        </div>
    </div>`
} 

function getProducts(MAINURL, endpoint){
    const url =  MAINURL + endpoint;
    return axios.get(url)
    .then(response => {
        console.log(response);
        return response.data;  
        })
}
    
function getProduct(MAINURL, endpoint, id){
    const url =  MAINURL + endpoint + `/${id}`;
    return axios.get(url)
    .then(response => {
            console.log(response);
            return response.data;  
        })
} //upcoming feature not useful rn.

function deleteProduct(MAINURL, endpoint, id){
    const url =  MAINURL + endpoint + `/${id}`;
    return axios.delete(url, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,  
        },
        data: {
            id: id 
        }
    })
    .then(response => {
            console.log(response);
            const container = document.getElementById('products-section');
            container.innerHTML ="";
            main();
            return response.data;  
        })
}

function createProduct(MAINURL, endpoint, data){
    const url =  MAINURL + endpoint;
    return axios.post(url, data, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,  
        },
    })
    .then(response => {
            console.log(response);
            return response.data;  
        })
}

function updateProduct(MAINURL, endpoint, id, updatedData){
    const url =  MAINURL + endpoint + `/${id}`;
    return axios.put(url, updatedData, {
        headers: {
            'X-CSRF-TOKEN': csrfToken,  
        },
    })
    .then(response => {
            console.log(response);
            return response.data;  
        })
}

// js fetch ignition
let main =  (MAINURL, endpoint) => {
    getProducts(MAINURL, endpoint).then(
            response => {
                if(response.data.prev_page_url != null){
                    let button = document.getElementById('prev');
                    button.addEventListener('click', ()=>{
                        console.log('prev')
                        const container = document.getElementById('products-section');
                        container.innerHTML = "";
                        main(response.data.prev_page_url, '')
                    });
                    //add event lister
                    //onclick fetch data using getProducts

                }
                if(response.data.next_page_url != null){
                    let button = document.getElementById('next');
                    button.addEventListener('click', ()=>{
                        console.log('next');
                        const container = document.getElementById('products-section');
                        container.innerHTML = "";
                        main(response.data.next_page_url, '')
                    });
                }

                console.log(response.data.data);
                if(response.data.data != null){
                    response.data.data.forEach(product => {
                        const container = document.getElementById('products-section');
                        container.innerHTML += producthtml(product.id, product.name, product.price, product.quantity, product.description);
                    
                        const modalButton = container.querySelectorAll('[data-modal-target="product"]');
                        const modalElement = document.getElementById('product');
                        
                        //delete
    
                        const deleteButtons = document.querySelectorAll('.delete-btn');
                        deleteButtons.forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.closest('[data-product-id]').getAttribute('data-product-id');
                                deleteProduct(MAINURL, '/products', productId);
                            });
                        });
    
                        // Initialize the modal using Flowbite's Modal class
                        if (modalButton && modalElement) {
                            const modal = new Modal(modalElement);
    
                            modalButton.forEach(button => {       
                                button.addEventListener('click', () => {
                                    //
                                    const productId = button.getAttribute('data-product-id');
                                    const productName = button.getAttribute('data-product-name');
                                    const productPrice = button.getAttribute('data-product-price');
                                    const productQuantity = button.getAttribute('data-product-quantity');
                                    const productDescription = button.getAttribute('data-product-description');
                                    
                                    // form
                                    let form = document.getElementById('updateForm');
                                    form.action = `/products/${productId}`;

                                    form.addEventListener('submit', async (event) => {
                                        console.log(productId);
                                        event.preventDefault();
                                        
                                        // Gather form data
                                        const formData = new FormData(form);
                                        const data = {
                                            name: formData.get('name'),
                                            price: parseFloat(formData.get('price')), // Ensure numbers are numbers
                                            quantity: parseFloat(formData.get('quantity')),
                                            description: formData.get('description'),
                                        };

                                        console.log(data);

                                        updateProduct(MAINURL, '/products', productId, data);
                                    });

                                    // Pass the values to the modal's input fields
                                    document.getElementById('product-name').value = productName;
                                    document.getElementById('product-price').value = productPrice;
                                    document.getElementById('product-quantity').value = productQuantity;
                                    document.getElementById('product-description').value = productDescription;
    
                                    modal.show();
    
                                });
                            });
                        }
                    
                    });
                }
            }
    );
    // craete form 
    let createForm = document.getElementById('createForm');
    createForm.addEventListener('submit', (event)=>{
        event.preventDefault();
        let name = document.getElementById('create-product-name').value;
        let price = document.getElementById('create-product-price').value;
        let quantity = document.getElementById('create-product-quantity').value;
        let description = document.getElementById('create-product-description').value;
        let data = {name, price, quantity, description};
        createProduct(MAINURL, '/products', data);
    });
}     
main(MAINURL, '/products');
