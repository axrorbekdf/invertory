<template>
    <div id="home">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Expenses</li>
		    </ol>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
	                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	                  <h6 class="m-0 font-weight-bold text-primary">Today orders</h6>
	                  <h6 class="m-0 font-weight-bold float-right text-primary">
	                  	<input type="text" v-model="searchTerm" class="form-control" placeholder="Search in data" name="">
	                  </h6>
	                </div>
	                <div class="table-responsive">
	                  <table class="table align-items-center table-flush">
	                    <thead class="thead-light">
	                      	<tr>
	                      		<th style="width: 100px;">Id</th>
		                        <th>Name</th>
		                        <th>Total Amount</th>
		                        <th>Pay</th>
		                        <th>Due</th>
		                        <th>PayBy</th>
		                        <th style="width:150px;">Action</th>
	                      	</tr>
	                    </thead>
	                    <tbody>
	                      	<tr v-for="order in filterSearch" :key="order.id">
	                      		<td><a href="#">{{ order.id }}</a></td>
		                        <td><a href="#">{{ order.name	 }}</a></td>
		                        <td><a href="#">{{ order.total	 }}</a></td>
		                        <td><a href="#">{{ order.pay	 }}</a></td>
		                        <td><a href="#">{{ order.due	 }}</a></td>
		                        <td><a href="#">{{ order.payby	 }}</a></td>
		                        <td>
		                        	<router-link :to="{ name: 'view-order', params:{id: order.id}}" class="btn btn-sm btn-primary">View</router-link>
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
        		orders: [],
        		searchTerm: '',
        	};
        },
        computed: {
        	filterSearch(){
        		return this.orders.filter(order => {
        			return order.name.match(this.searchTerm);
        		})
        	}
        },
        methods: {
        	allOrder(){
        		axios.post('/api/orders')
        		.then(({data}) => {this.orders = data})
        		.catch(error => { this.errors = error.response.data.errors; })
        	},
        

        },
        created(){
        	this.allOrder();
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