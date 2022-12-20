<template>
    <div id="home">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <router-link to="/store-category" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">Add Category</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Categories</li>
		    </ol>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
	                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	                  <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
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
		                        <th style="width:250px;">Action</th>
	                      	</tr>
	                    </thead>
	                    <tbody>
	                      	<tr v-for="category in filterSearch" :key="category.id">
	                      		<td><a href="#">{{ category.id }}</a></td>
		                        <td><a href="#">{{ category.category_name }}</a></td>
		                        <td>
		                        	<router-link :to="{ name: 'edit-category', params:{id: category.id}}" @click="editCategory(category)" class="btn btn-sm btn-primary">Edit</router-link>
		                        	<a href="#" @click="deleteCategory(category.id)" class="btn btn-sm btn-danger">Delete</a>
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
        		categories: [],
        		searchTerm: '',
        	};
        },
        computed: {
        	filterSearch(){
        		return this.categories.filter(category => {
        			return category.category_name.match(this.searchTerm);
        		})
        	}
        },
        methods: {
        	allCategories(){
        		axios.get('/api/categories')
        		.then(({data}) => (this.categories = data))
        		.catch(error => { this.errors = error.response.data.errors; })
        	},
        
        	deleteCategory(id){
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

				  	axios.delete('/api/categories/'+id)
				  	.then(() => {
				  		this.categories = this.categories.filter(category => {
				  			return category.id != id;
				  		});
				  	})
				  	.catch(() => {
				  		this.$router.push({ name: 'categories' });
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
        	this.allCategories();
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