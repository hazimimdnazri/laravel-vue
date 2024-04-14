<template>
    <form @submit.prevent="submitForm">
        <div class="input-group mb-3">
            <input type="text" v-model="name" class="form-control" placeholder="Full name">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
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
        <div class="input-group mb-3">
            <input type="password" v-model="password_confirm" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div>

            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>

        </div>
    </form>
</template>

<script>
export default {
    props: ['root_url'],
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirm: '',
        }
    },
    methods: {
        async submitForm () {
            customJs.runLoader('load')
            try {
                const response = await Promise.race([
                    axios.post(root_url+'/guest/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirm: this.password_confirm,
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