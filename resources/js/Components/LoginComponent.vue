<template>
    <form @submit.prevent="submitForm">
        <div class="input-group mb-3">
            <input type="email" v-model="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" v-model="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        async submitForm () {
            customJs.runLoader('load')
            try {
                const response = await Promise.race([
                    axios.post('//127.0.0.1:8000/guest/login', {
                        email: this.email,
                        password: this.password,
                    }),
                    new Promise((_, reject) => setTimeout(() => reject(new Error('Timeout')), 5000))
                ]);
                    
                if(response.status == 200){
                    if(response.data.status == 'success'){
                        location.reload()
                    } else {
                        customJs.runError(response.data.message)
                    }
                }
            } catch (error){
                customJs.runError('Timeout!')
            }
        }
    }
}
</script>