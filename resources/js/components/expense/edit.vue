<template>
    <div id="employee-create">
    	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		    <router-link to="/expenses" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">All Expenses</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Expenses</li>
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
                            <h1 class="h4 text-gray-900 mb-4">Add Expenses</h1>
                          </div>
                          <form class="create" @submit.prevent="expenseInsert" enctype="multipart/form-data">
                            <div class="form-group">
                              	<div class="form-row">
	                              	<div class="col-md-12">
	                              		<label>Details</label>
				                            <textarea class="form-control" v-model="form.details" id="exampleInputFullName" placeholder="Enter Details"> </textarea>
				                            <span class="text-danger" v-if="errors.details">{{ errors.details[0] }}<br></span>
	                              	</div>

                                  <div class="col-md-12">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" v-model="form.amount" id="exampleInputFullName" placeholder="Enter Amount">
                                    <span class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}<br></span>
                                  </div>

                                  <div class="col-md-12">
                                    <label>Expense Date</label>
                                    <input type="date" class="form-control" v-model="form.expense_date" id="exampleInputFullName" placeholder="Enter Expense Date">
                                    <span class="text-danger" v-if="errors.expense_date">{{ errors.expense_date[0] }}<br></span>
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
              details: '',
              amount: '',
              expense_date: '',
            },
            errors:{}
          }
        },
        created(){
          let id = this.$route.params.id;

          axios.get("/api/expenses/"+id)
          .then(({data}) => (this.form = data))
          .catch(console.log('error'))
        },
        methods:{

          	expenseInsert(){
              let id = this.$route.params.id;
	            axios.patch('/api/expenses/'+id, this.form)
	            .then(res => {

	                Notification.success();

	                this.$router.push({ name:'expenses' })

	            })
	            .catch(error => { this.errors = error.response.data.errors; })
          	}
        },
        mounted() {
            console.log('Component mounted.')
        },

    }
</script>
