<template>
    <div id="product">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <router-link to="/store-product" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">Add Product</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Stock</li>
		    </ol>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
	                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	                  <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
	                  <h6 class="m-0 font-weight-bold float-right text-primary">
	                  	<input type="text" v-model="searchTerm" class="form-control" placeholder="Search in data" name="">
	                  </h6>
	                </div>
	                <div class="table-responsive">
	                  <table class="table align-items-center table-flush">
	                    <thead class="thead-light">
	                      	<tr>
		                        <th>Name</th>
		                        <th>Code</th>
		                        <th>Image</th>
		                        <th>Category</th>
		                        <th>Buying Price</th>
		                        <th>Status</th>
		                        <th>Quantity</th>
		                        <th style="width:250px;">Action</th>
	                      	</tr>
	                    </thead>
	                    <tbody>
	                      	<tr v-for="product in filterSearch" :key="product.id">
		                        <td><a href="#">{{ product.product_name }}</a></td>
		                        <td>{{ product.product_code }}</td>
		                        <td><img :src="product.image" id="em_photo"></td>
		                        <td><a href="#">{{ product.category.category_name }}</a></td>
		                        <td>{{ product.buying_price }}</td>
		                        <td v-if="product.product_quantity > 1"> <span class="badge badge-success">Available</span></td>
		                        <td v-else=""> <span class="badge badge-danger">Stock out</span></td>
		                        <td>{{ product.product_quantity }}</td>
		                        <td>
		                        	<router-link :to="{ name: 'edit-stock', params:{id: product.id}}" @click="editProduct(product)" class="btn btn-sm btn-primary">Edit</router-link>
		                        </td>
	                      	</tr>
	                    </tbody>
	                  </table>
	                </div>
	                <div class="card-footer"></div>
              	</div>
			</div>
		</div>

		<div class="row">
		    <div class="col-lg-12 text-center">
		      <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
		          class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
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
        		products: [],
        		searchTerm: '',
        	};
        },
        computed: {
        	filterSearch(){
        		return this.products.filter(product => {
        			return product.product_name.match(this.searchTerm);
        		})
        	}
        },
        methods: {
        	allProducts(){
        		axios.get('/api/products')
        		.then(({data}) => (this.products = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},
        
        },
        created(){
        	this.allProducts();
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>


<style type="text/css" scoped>
	#em_photo{
		width: 40px;
		height: 40px;
	}
</style>