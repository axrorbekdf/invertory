<template>
    <div id="product-create">
    	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		    <router-link to="/products" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">All Products</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Products</li>
		    </ol>
		  </div>

        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 col-md-12">
                <div class="card shadow-sm my-0">
                  <div class="card-body p-0">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="login-form">
                          <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add Products</h1>
                          </div>
                          <form class="create" @submit.prevent="productInsert" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-6">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" v-model="form.product_name" id="exampleInputFullName" placeholder="Enter Product Name">
                                    <span class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}<br></span>

                                    <label class="mt-3">Categories</label>
                                    <select class="form-control" v-model="form.category_id">
                                      <option v-for="category in categories" :key="category.id" :value="category.id">{{category.category_name}}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</span>

                                    <label class="mt-3">Product Code</label>
                                    <input type="text" class="form-control" v-model="form.product_code" placeholder="Enter Product code">
                                    <span class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Photo</label>
                                    <img :src="form.image" style="width: 75%; height: 160px; display: block; margin: 0px 5px 25px 5px;">

                                    <div class="custom-file">
                                        <input type="file" @change="onFileSelected" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <span class="text-danger" v-if="errors.image">{{ errors.image[0] }}</span>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-6">
                                    <label>Buying Price</label>
                                    <input type="text" class="form-control" v-model="form.buying_price" placeholder="Enter Buying Price">
                                    <span class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Selling Price</label>
                                    <input type="text" class="form-control" v-model="form.selling_price" placeholder="Enter Selling Price">
                                    <span class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</span>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-6">
                                    <label>Root</label>
                                    <input type="text" class="form-control" v-model="form.root" placeholder="Enter Root">
                                    <span class="text-danger" v-if="errors.root">{{ errors.root[0] }}</span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Suppliers</label>
                                    <select class="form-control" v-model="form.supplier_id">
                                      <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{supplier.name}}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</span>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-6">
                                    <label>Product Quantity</label>
                                    <input type="text" class="form-control" v-model="form.product_quantity" placeholder="Enter Product Quantity">
                                    <span class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</span>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Buying Date</label>
                                    <input type="date" class="form-control" v-model="form.buying_date" placeholder="Enter Buying Date">
                                    <span class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</span>
                                  </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                          </form>
                          <hr>
                          
                          <div class="text-center">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created(){
          if(!User.loggedIn()){
            this.$router.push({ name:'login' })
          }
        },
        data(){
          return {
            form:{
              category_id: null,
              product_name: null,
              product_code: null,
              root: null,
              buying_price: null,
              selling_price: null,
              supplier_id: null,
              buying_date: null,
              image: null,
              product_quantity: null,
            },
            errors:{},
            categories:{},
            suppliers:{},
          }
        },
        methods:{
            allCategories(){
              axios.get('/api/categories')
              .then(({data}) => (this.categories = data))
              .catch(error => { this.errors = error.response.data.errors; })
            },

            allSuppliers(){
              axios.get('/api/suppliers')
              .then(({data}) => (this.suppliers = data))
              .catch(error => { this.errors = error.response.data.errors; })
            },

            onFileSelected(event){
              let file = event.target.files[0];
              if(file.size > 1048770){
                Notification.image_validation();
              }else{
                const reader = new FileReader();
                reader.onload = (evt) => {
                  this.form.image = evt.target.result;
                };
                reader.readAsDataURL(file);
              }
            },

          	productInsert(){
	            axios.post('/api/products', this.form)
	            .then(res => {

	                Notification.success();

	                this.$router.push({ name:'products' })

	            })
	            .catch(error => { this.errors = error.response.data.errors; })
          	}
        },
        created(){
          this.allCategories();
          this.allSuppliers();
        },
        mounted() {
            console.log('Component mounted.')
        },

    }
</script>
