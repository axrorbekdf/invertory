<template>
    <div id="employee-create">
    	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		    <router-link to="/categories" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">All Categories</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
                            <h1 class="h4 text-gray-900 mb-4">Add Categories</h1>
                          </div>
                          <form class="create" @submit.prevent="categoryInsert" enctype="multipart/form-data">
                            <div class="form-group">
                              	<div class="form-row">
	                              	<div class="col-md-12">
	                              		<label>Category Name</label>
				                            <input type="text" class="form-control" v-model="form.category_name" id="exampleInputFullName" placeholder="Enter Your Category Name">
				                            <span class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}<br></span>
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
							category_name: null,
            },
            errors:{}
          }
        },
        methods:{

          	categoryInsert(){
	            axios.post('/api/categories', this.form)
	            .then(res => {

	                Notification.success();

	                this.$router.push({ name:'categories' })

	            })
	            .catch(error => { this.errors = error.response.data.errors; })
          	}
        },
        mounted() {
            console.log('Component mounted.')
        },

    }
</script>
