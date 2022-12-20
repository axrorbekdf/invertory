<template>
    <div id="employee-create">
    	<div class="d-sm-flex align-items-center justify-content-between mb-1">
		    <router-link to="/salary" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">All Salaries</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Salaries</li>
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
                            <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                          </div>
                          <form class="create" @submit.prevent="salaryInsert">
                            <div class="form-group">
                              	<div class="form-row">
	                              	<div class="col-md-6">
	                              		<label>Employee Name</label>
                                    <input type="text" class="form-control" v-model="form.name" id="exampleInputFullName" placeholder="Enter Employee Name">
				                            <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}<br></span>
	                              	</div>
                                  <div class="col-md-6">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" v-model="form.amount" id="exampleInputFullName" placeholder="Enter Amount">
                                    <span class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}<br></span>
                                  </div>
                              		
                              	</div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-4">
                                    <label>Salary Date</label>
                                    <input type="date" class="form-control" v-model="form.salary_date" id="exampleInputFullName" placeholder="Enter Salary Date">
                                    <span class="text-danger" v-if="errors.salary_date">{{ errors.salary_date[0] }}<br></span>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Salary Month</label>
                                    
                                    <select class="form-control" v-model="form.salary_month">
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}<br></span>
                                  </div>
                                  <div class="col-md-4">
                                    <label>Salary Year</label>
                                    <select class="form-control" v-model="form.salary_year">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.salary_year">{{ errors.salary_year[0] }}<br></span>
                                  </div>
                                  
                                </div>
                            </div>

                            <div class="form-group">
                              <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
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
              amount: null,
              salary_date: null,
              salary_month: null,
              salary_year: null,
            },
            errors:{},
            employees: {},
          }
        },
        created(){
          this.getEmployee();
        },
        methods:{
            getEmployee(){

              let id = this.$route.params.id;
              axios.get("/api/employees/"+id)
              .then(({data}) => (this.form = data))
              .catch(console.log('error'))
            },

          	salaryInsert(){
              let id = this.$route.params.id;
	            axios.post('/api/salary/paid/'+id, this.form)
	            .then(res => {

	                Notification.success();

	                this.$router.push({ name:'given-salary' })

	            })
	            .catch(error => { this.errors = error.response.data.errors; })
          	}
        },
        mounted() {
            this.form.employee_id = this.$router.params.id;

            console.log(this.form.employee_id)
            console.log('Component mounted.')
        },

    }
</script>
