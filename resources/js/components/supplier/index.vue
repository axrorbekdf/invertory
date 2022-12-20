<template>
    <div id="home">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <router-link to="/store-supplier" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">Add Suppliers</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
		    </ol>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
	                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	                  <h6 class="m-0 font-weight-bold text-primary">Suppliers List</h6>
	                  <h6 class="m-0 font-weight-bold float-right text-primary">
	                  	<input type="text" v-model="searchTerm" class="form-control" placeholder="Search in data" name="">
	                  </h6>
	                </div>
	                <div class="table-responsive">
	                  <table class="table align-items-center table-flush">
	                    <thead class="thead-light">
	                      	<tr>
		                        <th>Name</th>
		                        <th>Photo</th>
		                        <th>Phone</th>
		                        <th>Address</th>
		                        <th>Shopname</th>
		                        <th>Action</th>
	                      	</tr>
	                    </thead>
	                    <tbody>
	                      	<tr v-for="supplier in filterSearch" :key="supplier.id">
		                        <td><a href="#">{{ supplier.name }}</a></td>
		                        <td><img :src="supplier.photo" id="em_photo"></td>
		                        <td>{{ supplier.phone }}</td>
		                        <td><span class="badge badge-success">{{ supplier.address }}</span></td>
		                        <td><span class="badge badge-success">{{ supplier.shopname }}</span></td>
		                        <td>
		                        	<router-link :to="{ name: 'edit-supplier', params:{id: supplier.id}}" @click="editSupplier(supplier)" class="btn btn-sm btn-primary">Edit</router-link>
		                        	<a href="#" @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</a>
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
        		suppliers: [],
        		searchTerm: '',
        	};
        },
        computed: {
        	filterSearch(){
        		return this.suppliers.filter(supplier => {
        			return supplier.name.match(this.searchTerm);
        		})
        	}
        },
        methods: {
        	allSuppliers(){
        		axios.get('/api/suppliers')
        		.then(({data}) => (this.suppliers = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},
        
        	deleteSupplier(id){
        		Swal.fire({
				  title: 'Are you sure?',
				  text: "You won't be able to revert this!",
				  icon: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
				  if (result.isConfirmed) {

				  	axios.delete('/api/suppliers/'+id)
				  	.then(() => {
				  		this.suppliers = this.suppliers.filter(supplier => {
				  			return supplier.id != id;
				  		});
				  	})
				  	.catch(() => {
				  		this.$router.push({ name: 'suppliers' });
				  	})

				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
				})
        	}

        },
        created(){
        	this.allSuppliers();
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