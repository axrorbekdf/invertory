<template>
    <div id="forget">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="card shadow-sm my-5">
                  <div class="card-body p-0">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="login-form">
                          <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Forget Password</h1>
                          </div>
                          <form class="user">
                            <div class="form-group">
                              <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                              <a href="index.html" class="btn btn-primary btn-block">Forget Passrod</a>
                            </div>
                          </form>
                          <hr>  
                          <div class="text-center">
                            <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                          </div>
                          <div class="text-center">
                            <router-link to="/" class="font-weight-bold small">Back to Login!</router-link>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
