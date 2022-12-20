<template>
    <div id="employee-create">
    	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		    <router-link to="/suppliers" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">All Suppliers</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
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
                            <h1 class="h4 text-gray-900 mb-4">Add Suppliers</h1>
                          </div>
                          <form class="create" @submit.prevent="supplierInsert" enctype="multipart/form-data">
                            <div class="form-group">
                              	<div class="form-row">
	                              	<div class="col-md-6">
	                              		<label>Full Name</label>
			                            <input type="text" class="form-control" v-model="form.name" id="exampleInputFullName" placeholder="Enter Your Full Name">
			                            <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}<br></span>

			                            <label class="mt-3">Email</label>
			                            <input type="email" class="form-control" v-model="form.email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Your Email Address">
			                            <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>

			                            <label class="mt-3">Phone</label>
			                            <input type="text" class="form-control" v-model="form.phone" placeholder="Enter Your Phone">
			                            <span class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</span>
	                              	</div>
                              		<div class="col-md-6">
                              			<label>Photo</label>
			                            <img :src="form.photo" style="width: 75%; height: 160px; display: block; margin: 0px 5px 25px 5px;">

                              			<div class="custom-file">
					                        <input type="file" @change="onFileSelected" class="custom-file-input" id="customFile">
					                        <label class="custom-file-label" for="customFile">Choose file</label>
					                        <span class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</span>
					                    </div>
                              		</div>
                              	</div>
                            </div>

                            <div class="form-group">
                              	<div class="form-row">
	                              	<div class="col-md-6">
	                              		<label>Shopname</label>
			                            <input type="text" class="form-control" v-model="form.shopname" placeholder="Enter Your Nid">
			                            <span class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</span>
	                              	</div>
	                              	<div class="col-md-6">
	                              		<label>Address</label>
			                            <input type="text" class="form-control" v-model="form.address" placeholder="Enter Your Address">
			                            <span class="text-danger" v-if="errors.address">{{ errors.address[0] }}</span>
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
							name: null,
							email: null,
							phone: null,
							address: null,
							photo: null,
							shopname: null,
            },
            errors:{}
          }
        },
        methods:{
	        	onFileSelected(event){
	        		let file = event.target.files[0];
	        		if(file.size > 1048770){
	        			Notification.image_validation();
	        		}else{
	        			const reader = new FileReader();
								reader.onload = (evt) => {
									this.form.photo = evt.target.result;
								};
								reader.readAsDataURL(file);
	        		}
	        	},

          	supplierInsert(){
	            axios.post('/api/suppliers', this.form)
	            .then(res => {

	                Notification.success();

	                this.$router.push({ name:'suppliers' })

	            })
	            .catch(error => { this.errors = error.response.data.errors; })
          	}
        },
        mounted() {
            console.log('Component mounted.')
        },

    }
</script>
