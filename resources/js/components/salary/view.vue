<template>
    <div id="home">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
		    <router-link to="/salary" class="nav-link btn-primary">
		    	<h1 class="h3 mb-0 text-white-800">Go Back</h1>
		    </router-link>
		    <ol class="breadcrumb">
		      <li class="breadcrumb-item"><a href="./">Home</a></li>
		      <li class="breadcrumb-item active" aria-current="page">Salary</li>
		    </ol>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
	                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	                  <h6 class="m-0 font-weight-bold text-primary">Employee Salaries Details</h6>
	                  <h6 class="m-0 font-weight-bold float-right text-primary">
	                  	<input type="text" v-model="searchTerm" class="form-control" placeholder="Search in data" name="">
	                  </h6>
	                </div>
	                <div class="table-responsive">
	                  <table class="table align-items-center table-flush">
	                    <thead class="thead-light">
	                      	<tr>
		                        <th>Name</th>
		                        <th>Mounth</th>
		                        <th>Amount</th>
		                        <th>Date</th>
		                        <th>Action</th>
	                      	</tr>
	                    </thead>
	                    <tbody>
	                      	<tr v-for="salary in filterSearch" :key="salary.id">
		                        <td><a href="#">{{ salary.employee.name }}</a></td>
		                        <td>{{ salary.salary_month }}</td>
		                        <td><span class="badge badge-success">{{ salary.amount }}</span></td>
		                        <td><span class="badge badge-success">{{ salary.salary_date }}</span></td>
		                        <td>
		                        	<router-link :to="{ name: 'edit-salary', params:{id: salary.id}}" class="btn btn-sm btn-primary">Edit Salary</router-link>
		                        	
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
        		salaries: [],
        		searchTerm: '',
        	};
        },
        computed: {
        	filterSearch(){
        		return this.salaries.filter(salary => {
        			return salary.employee.name.match(this.searchTerm);
        		})
        	}
        },
        methods: {
        	viewSalaries(){
        		let month = this.$route.params.month;
        		axios.post('/api/salary/view/'+month)
        		.then(({data}) => {this.salaries = data})
        		.catch(error => { this.errors = error.response.data.errors; })
        	},
        
        

        },
        created(){
        	this.viewSalaries();
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