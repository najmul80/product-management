<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Product List | Product Management</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap 5 CDN -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
      
      <!-- jQuery (MUST come first) -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- SweetAlert2 CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      <!-- SweetAlert2 JS -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!-- Toastr CSS -->
      <link href="<?php echo e(asset('assets/toastr.min.css')); ?>" rel="stylesheet">

      <!-- Toastr JS -->
      <script src="<?php echo e(asset('assets/toastr.min.js')); ?>"></script>
      <!-- Axios CDN -->
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <style>
         body {
         background-color: #f8f9fa;
         }
         .table-actions button { 
         margin-right: 5px;
         }
      </style>
   </head>
   <body>
      <div class="container mt-5">
         <h2 class="text-center mb-4">📦 Product Management Table</h2>
         <div class="card shadow-sm">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center mb-3">
                  <h2>📦 Product List</h2>
                  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                  ➕ Add Product
                  </button>
               </div>
               <div id="loader" style="display: none; text-align: center;">
                  <div class="col-12">
                     <button type="button" class="btn btn-dark waves-effect waves-light w-20">
                     <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> 
                     Loading data... Please wait.
                     </button>
                  </div>
               </div>
               <hr>
             
               <table class="table table-bordered table-striped align-middle text-center">
                  <thead class="table-dark">
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price ($)</th>
                        <th>Stock</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="productsTable">
                     <div id="noDataMessage" style="display: none;">No products available.</div>
                  </tbody>
               </table>
               <div id="error" class="text-danger text-center mt-3"></div>
            </div>
         </div>
      </div>

      <!-- Add Product Modal -->
      <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <form id="addProductForm" class="modal-content" onsubmit="addProduct(event)">
               <div class="modal-header">
                  <h5 class="modal-title" id="addProductModalLabel">➕ Add New Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="addProductName" required maxlength="100">
                  </div>
                  <div class="mb-3">
                     <label for="productDescription" class="form-label">Description</label>
                     <textarea class="form-control" id="addProductDescription" rows="2"></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="productPrice" class="form-label">Price <span class="text-danger">*</span></label>
                     <input type="number" class="form-control" id="addProductPrice" required step="0.01" min="0">
                  </div>
                  <div class="mb-3">
                     <label for="productStock" class="form-label">Stock</label>
                     <input type="number" class="form-control" id="addProductStock" value="0" min="0">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Save Product</button>
               </div>
            </form>
         </div>
      </div>
      <!-- Edit Product Modal -->
      <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <form id="editProductForm" class="modal-content" onsubmit="updateProduct(event)">
               <div class="modal-header">
                  <h5 class="modal-title" id="editProductModalLabel">Update Exiting Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <input type="hidden" id="editProductId">
               <div class="modal-body">
                  <div class="mb-3">
                     <label for="productName" class="form-label">Product Name <span class="text-danger">*</span></label>
                     <input type="text" class="form-control" id="editProductName" required maxlength="100">
                  </div>
                  <div class="mb-3">
                     <label for="productDescription" class="form-label">Description</label>
                     <textarea class="form-control" id="editProductDescription" rows="2"></textarea>
                  </div>
                  <div class="mb-3">
                     <label for="productPrice" class="form-label">Price <span class="text-danger">*</span></label>
                     <input type="number" class="form-control" id="editProductPrice" required step="0.01" min="0">
                  </div>
                  <div class="mb-3">
                     <label for="productStock" class="form-label">Stock</label>
                     <input type="number" class="form-control" id="editProductStock" value="0" min="0">
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Save Product</button>
               </div>
            </form>
         </div>
      </div>
      <script>
        // get products
         async function loadProducts() {
             let noDataMessage = document.getElementById("noDataMessage");
             let tableBody = document.getElementById("productsTable");
             let loader = document.getElementById("loader");
             loader.style.display = 'block';
             tableBody.innerHTML = ''; //Clear table content
             
             try {
                 let responseUrl = await axios.get("<?php echo e(route('products.index')); ?>");
                 let products = responseUrl.data.products;
                 loader.style.display = "none";
                 
                 if (products.length === 0) {
                     noDataMessage.style.display = '';
                     return;
                 }
                 noDataMessage.style.display = 'none';
                 products.forEach(product => {
                     let row = document.createElement('tr');
                     row.innerHTML = `
                         <td>${product.id}</td>
                         <td>${product.name}</td>
                         <td>${product.description || '-'}</td>
                         <td>${parseFloat(product.price).toFixed(2)}</td>
                         <td>${product.stock}</td>
                         <td class="table-actions">
                             <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})">Edit</button>
                             <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})">Delete</button>
                         </td>
                     `;
                     tableBody.appendChild(row);
                 })
             } catch (error) {
                 console.log('Something went wrong. Please try again.');
             }
         }
         loadProducts()
         

        // Add new product
        async function addProduct(event) {
          event.preventDefault(); // Prevent form submission

          const form = document.getElementById("addProductForm");
          const name = document.getElementById("addProductName").value.trim();
          const description = document.getElementById("addProductDescription").value.trim();
          const price = document.getElementById("addProductPrice").value.trim();
          const stock = document.getElementById("addProductStock").value.trim();

          // Basic validation
          if (!name || !description || isNaN(price) || isNaN(stock)) {
            errorMessage.textContent = "Please fill in all required fields correctly.";
            errorMessage.classList.remove("d-none");
            return;
          }

          try {
            const response = await axios.post("<?php echo e(route('products.store')); ?>", {
              name: name,
              description: description,
              price: parseFloat(price),
              stock: parseInt(stock)
            });

            console.log("Product added:", response.data);

            toastr.success('Product added successfully!');
            setTimeout(() => {

              // Reset form
              form.reset();

              // Close modal
              const modalElement = document.getElementById('addProductModal');
              const modalInstance = bootstrap.Modal.getInstance(modalElement);
              if (modalInstance) {
                modalInstance.hide();
              }

              location.reload(); 
            }, 1500);
            
          } catch (error) {
            console.error("Error adding product:", error);
            errorMessage.textContent = "Failed to add product. Please try again.";
            errorMessage.classList.remove("d-none");
          }
        }



         // edit product
         async function editProduct(id) {
            try {
               const editUrl = "<?php echo e(route('products.show', ':id')); ?>"
               const URL = editUrl.replace(':id', id);
               const response = await axios.get(URL);
               const product = response.data.product;

               document.getElementById('editProductId').value = product.id;
               document.getElementById('editProductName').value = product.name;
               document.getElementById('editProductDescription').value = product.description || '';
               document.getElementById('editProductPrice').value = product.price;
               document.getElementById('editProductStock').value = product.stock;

               const modalElement = document.getElementById('editProductModal');
               const modal = new bootstrap.Modal(modalElement);
               modal.show();
            } catch (error) {
               console.error("Failed to load product for editing:", error);
            }
        }

         
        // update product
         async function updateProduct(event) {
            event.preventDefault();

            const form = document.getElementById("editProductForm");
            const editProductId = document.getElementById("editProductId").value;

            const name = document.getElementById("editProductName").value.trim();
            const description = document.getElementById("editProductDescription").value.trim();
            const price = document.getElementById("editProductPrice").value.trim();
            const stock = document.getElementById("editProductStock").value.trim();

            // Basic validation
            if (!name || isNaN(price) || isNaN(stock)) {
              errorMessage.textContent = "Please fill in all required fields correctly.";
              errorMessage.classList.remove("d-none");
              return;
            }

            try {
                  const updateUrl = "<?php echo e(route('products.update', ':id')); ?>"
                  const URL = updateUrl.replace(':id', editProductId);
                  const response = await axios.post(URL, {
                     _method: 'PUT',
                     name: name,
                     description: description,
                     price: parseFloat(price),
                     stock: parseInt(stock)
                  });

                  console.log("Product updated:", response.data);

                  toastr.success('Product updated successfully!');

                  setTimeout(() => {

                     // Reset form
                     form.reset();

                     // Close modal
                     const modalElement = document.getElementById('editProductModal');
                     const modalInstance = bootstrap.Modal.getInstance(modalElement);
                     if (modalInstance) {
                        modalInstance.hide();
                     }

                     location.reload(); 
                  }, 1500);
              
            } catch (error) {
              console.error("Error updating product:", error);
              errorMessage.textContent = "Failed to update product. Please try again.";
              errorMessage.classList.remove("d-none");
            }
          }

         
        
          // Delete product
        
         function deleteProduct(id) {
            Swal.fire({
               title: 'Are you sure?',
               text: "You won't be able to revert this!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#d33',
               cancelButtonColor: '#3085d6',
               confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
               if (result.isConfirmed) {
                  try {
                  const url = "<?php echo e(route('products.destroy', ':id')); ?>".replace(':id', id);
                  await axios.delete(url);
                  Swal.fire('Deleted!', 'The product has been deleted.', 'success');
                  setTimeout(() => {
                     location.reload(); 
                  }, 1500);
                  } catch (error) {
                  console.error(error);
                  Swal.fire('Error!', 'Failed to delete product.', 'error');
                  }
               }
            });
         }


      </script>
   </body>
</html><?php /**PATH C:\xampp\htdocs\Product Api\resources\views/welcome.blade.php ENDPATH**/ ?>