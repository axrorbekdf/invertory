<template>
    <div id="pos">
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pos</li>
            </ol>
          </div>

          <div class="row mb-3">
            

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <a class="btn btn-sm btn-info"><font color="#ffffff">Add Customer</font></a>
                </div>

                
              	<div class="table-responsive" style="font-size: 10px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th style="width: 150px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td><a href="#">{{ cart.pro_name}}</a></td>
                        <td style="font-size: 22px">
                          
                          {{ cart.pro_quantity}}
                          <!-- <input type="text" readonly style="width:15px" :value="cart.pro_quantity"> -->
                        </td>
                        <td>{{ cart.product_price}}</td>
                        <td><span class="badge badge-success">{{ cart.sub_total}}</span></td>
                        <td>
                          <a href="#" @click.prevent="decrement(cart.id)" class="btn btn-primary btn-sm" v-if="cart.pro_quantity >= 2">
                            <i class="fab fa-minus fa"></i>
                          </a>
                          <a href="#" class="btn btn-primary btn-sm" v-else="" style="opacity: 0.5;">
                            <i class="fab fa-minus fa"></i>
                          </a>
                          

                          <a href="#" @click.prevent="removeItem(cart.id)" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </a>

                          <a href="#" @click.prevent="increment(cart.id)" class="btn btn-primary btn-sm">
                            <i class="fab fa-plus fa"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              	</div>

              	<div class="card-footer">
              		<ul class="list-group">
              			<li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity: <strong>{{ qty }}</strong></li>
              			<li class="list-group-item d-flex justify-content-between align-items-center">Sub Total: <strong>${{ subtotal }}</strong></li>
              			<li class="list-group-item d-flex justify-content-between align-items-center">Vat: <strong>{{ vats.vat }}%</strong></li>
              			<li class="list-group-item d-flex justify-content-between align-items-center">Total: <strong>$ {{ subtotal*vats.vat/100 + subtotal }}</strong></li>
              		</ul>

              		<br><br>

              		<form @submit.prevent="orderdone">
              			<label>Customer Name</label>
              			<select class="form-control" v-model="customer_id">
              				<option v-for="customer in customers " :key="customer.id" :value="customer.id">{{ customer.name }}</option>
              			</select>

              			<label>Pay</label>
              			<input type="text" class="form-control" v-model="pay" required>

                    <label>Due</label>
                    <input type="text" class="form-control" required="" v-model="due">

              			<label>Pay By</label>
              			<select class="form-control" v-model="payby">
              				<option value="HadCash">Hand Cash</option>
              				<option value="Cheaque">Cheaque</option>
              				<option value="GiftCard">Gift Card</option>
              			</select>
              			
              			<br>

              			<button type="submit" class="btn btn-success">Submit</button>
              		</form>

              	</div>



              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>

                  <h6 class="m-0 font-weight-bold float-right text-primary">
                  	<input type="text" v-model="searchTerm" class="form-control" placeholder="Search in data" name="">
                  </h6>
                </div>
                <div class="card-body pt-0">

                  		<!-- BEGIN TABS -->

                  		<!-- <div class="card"> -->
			              	<div class="card-header d-flex p-0">
			                	<h3 class="card-title pt-3 pb-0 m-0">Categories</h3>
				                <ul class="nav nav-pills ml-auto p-2">
				                  	<li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab">All</a></li>
				                  	<li v-for="item in categories" :key="item.id" class="nav-item">
				                  		<a class="nav-link" href="#getProduct" data-toggle="tab" @click="subProduct(item.id)">{{ item.category_name}}</a>
				                  	</li>
				                </ul>
			              	</div><!-- /.card-header -->
			              	<div class="card-body p-0 pt-2">
				                <div class="tab-content">
				                  	<div class="tab-pane active" id="all">
				                    
					                    <div class="row">
					                    	<div v-for="product in filterSearch" :key="product.id" class="col-lg-3 col-md-3 col-sm-6 col-6">
						                  		<button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
						                  			<div class="card" style="width: 10rem;">
							                  			<img class="card-img-top" :src="product.image" id="em_photo">
							                  			<div class="card-body pb-0 text-center">
							                  				<h6 class="card-title">{{ product.product_name }}</h6>

															<span v-if="product.product_quantity > 1" class="badge badge-success">Available {{product.product_quantity}}</span>
															<span v-else="" class="badge badge-danger">Stock out</span>
							                  			</div>
							                  		</div>
						                  		</button>
						                  	</div>
					                    </div>

				                  	</div>
				                  	<!-- /.tab-pane -->
				                  	<div class="tab-pane" id="getProduct">
				                    
				                    	<div class="row">
				                    		<div v-for="getproduct in getFilterSearch" :key="getproduct.id" class="col-lg-3 col-md-3 col-sm-6 col-6">
						                  		<button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
						                  			<div class="card" style="width: 10rem;">
							                  			<img class="card-img-top" :src="getproduct.image" id="em_photo">
							                  			<div class="card-body pb-0 text-center">
							                  				<h6 class="card-title">{{ getproduct.product_name }}</h6>

															<span v-if="getproduct.product_quantity > 1" class="badge badge-success">Available {{getproduct.product_quantity}}</span>
															<span v-else="" class="badge badge-danger">Stock out</span>
							                  			</div>
							                  		</div>
						                  		</button>
						                  	</div>
				                    	</div>

				                  	</div>
				                  	<!-- /.tab-pane -->

				                </div>
				                <!-- /.tab-content -->
			              	</div><!-- /.card-body -->
			            <!-- </div> -->

                  		<!-- END TABS -->

                </div>                
              </div>
            </div>
            
          </div>
          <!--Row-->

          <div class="row">
            <div class="col-lg-12 text-center">
              <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                  class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
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

            customer_id:'',
            pay:'',
            due:'',
            payby:'',

        		products: [],
        		categories: [],
        		getproducts: [],
        		searchTerm: '',
        		customers: [],
            carts: [],
            vats: [],
        	};	
        },
        computed: {
        	filterSearch(){
        		return this.products.filter(product => {
        			return product.product_name.match(this.searchTerm);
        		})
        	},

        	getFilterSearch(){
        		return this.getproducts.filter(product => {
        			return product.product_name.match(this.searchTerm);
        		})
        	},
          qty(){
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
              sum += (parseFloat((this.carts[i]).pro_quantity));
            }

            return sum;
          },
          subtotal(){
            let sum = 0;
            for (let i = 0; i < this.carts.length; i++) {
              sum += (parseFloat((this.carts[i]).pro_quantity)*parseFloat((this.carts[i]).product_price));
            }

            return sum;
          },

        },
        methods: {

          // BEGIN CART

          AddToCart(productId){
            axios.get('/api/addToCart/'+productId)
            .then(() => {

                Reload.$emit('AfterAdd');
                Notification.cart_success();
            })
            .catch()

          },

          cartProducts(){
            axios.get('/api/cart/products')
            .then(({data}) => (this.carts = data))
            .catch()
          },

          removeItem(productId){
            axios.get('/api/remove/cart/'+productId)
            .then(() => {

                Reload.$emit('AfterAdd');
                Notification.cart_delete();
            })
            .catch()
          },

          increment(productId){
            axios.get('/api/increment/cart/'+productId)
            .then(() => {

                Reload.$emit('AfterAdd');
                Notification.success();
            })
            .catch()
          },
          decrement(productId){
            axios.get('/api/decrement/cart/'+productId)
            .then(() => {

                Reload.$emit('AfterAdd');
                Notification.success();
            })
            .catch()
          },
          vat(){
            axios.get('/api/vats')
            .then(({data}) => (this.vats = data))
            .catch(error => { this.errors = error.response.data.errors; })
          },

          orderdone(){
            let total = this.subtotal*this.vats.vat/100 + this.subtotal;
            let data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, pay:this.pay, due:this.due, payby:this.payby,  vat:this.vats.vat, total:total};

            axios.post('/api/orderdone', data)
            .then(({data}) => {
                this.$router.push({name:'home'});
                Notification.success();
            })
          },

          // END CART

        	allProducts(){
        		axios.get('/api/products')
        		.then(({data}) => (this.products = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},

        	allCategories(){
        		axios.get('/api/categories')
        		.then(({data}) => (this.categories = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},

        	allCustumers(){
        		axios.get('/api/customers')
        		.then(({data}) => (this.customers = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},

        	subProduct(id){
        		axios.get('/api/getting/product/'+id)
        		.then(({data}) => (this.getproducts = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},	

        },
        created(){
        	this.allProducts();
        	this.allCategories();
        	this.allCustumers();
          this.cartProducts();
          this.vat();

          Reload.$on('AfterAdd', () => {
            this.cartProducts();
          });
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>


<style type="text/css" scoped>
	#em_photo{
		width: 100%;
		height: 130px;
	}
</style>