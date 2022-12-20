<template>
    <div id="logout">
        
    </div>
</template>

<script>
    export default {
        created(){
          localStorage.removeItem('token');
          localStorage.removeItem('user');

          Toast.fire({
            icon: 'success',
            title: 'Logout in successfully'
          })

          this.$router.push({ name: '/'});
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
