<template>
<div>
		<a-row style="padding-top:40px">
			<a-col :xs="2" :sm="3" :md="8"/>
			<a-col :xs="21" :sm="18" :md="8">
				<a-card>
					<a-row>
						<a-form-item
							:validate-status="usernameError?'error':''"
							:help="usernameError"
						>	
							<span slot="label">Tên đăng nhập <span style="color:red">*</span></span>
							<a-input placeholder="Nhập tên đăng nhập" v-model="userName" v-on:keyup.enter="login"/>
						</a-form-item>
					</a-row>
					<a-row>
						<a-form-item
							:validate-status="passwordError?'error':''"
							:help="passwordError"
						>
							<span slot="label">Mật khẩu <span style="color:red">*</span></span>
							<a-input placeholder="Nhập mật khẩu" type="password" v-model="password" v-on:keyup.enter="login"/>
						</a-form-item>
					</a-row>
					<!-- <a-row>
						<a-form-item>
							<a-checkbox @change="onSaveLogin">Nhớ tài khoản</a-checkbox>
						</a-form-item>
					</a-row> -->
					<a-row>
						<a-form-item>
							<a-button type="primary" :loading="loadingData" @click="login">Đăng nhập</a-button>
						</a-form-item>
					</a-row>
				</a-card>
			</a-col>
			<a-col :xs="2" :sm="3" :md="7"/>
		</a-row>
	</div>
</template>
<script>
export default {
	data(){
		return{
			userName: '',
			password: '',
			successState: false,
			successStatePass: false,
            loadingData: false,
			usernameError: '',
			passwordError: '',
			saveLogin: false
		}		
	},
	methods: {
		login: function(){
			this.loadingData = true;
			if(this.userName == '' || this.password == ''){
				this.loadingData = false;
			}
			else{
				this.$axios.post('/login', {
					username: this.userName,
					password: this.password
				}).then(res => {
					if(res.token){
						let token = res.token;
						// let menu = res.menu;
						let user = res.user_data;
						if(this.saveLogin){
							// localStorage.loginData = JSON.stringify({username: this.userName, password: this.password, saveLogin: this.saveLogin});
						}

						this.redirectPage(token, user);
                    }
                    else{
                        this.loadingData = false;
                        let error = res.error;
						if(error.username){
							if(error.username[0]){
                                this.usernameError = error.username[0];
                            }
						}
						if(error.password){
							if(error.password[0]){
                                this.passwordError = error.password[0];
                            }
						}
						if(error.error_login){
							this.usernameError = error.error_login;
						}
						if(error.wrongPassOrUser){
							this.usernameError = error.wrongPassOrUser;
						}
                    }
				}).catch(e => {
					this.loadingData = true;
				})
			}		
		},
		changeStateTrue: function(){
			this.successState = true;
		},
		changeStateFalse: function(){
			this.successState = false;
		},
		changeStateTruePass: function(){
			this.successStatePass = true;
		},
		changeStateFalsePass: function(){
			this.successStatePass = false;
		},
        forgotPassword: function(){
            
		},
		redirectPage: function(token, user){
			this.$store.commit('setToken', token);
			// this.$store.commit('setMenu', menu);
			this.$store.commit('setUser', user);
			this.$router.push('/');
		},
		onSaveLogin: function(e){
			this.saveLogin = e.target.checked;
		}
	},
	mounted: function(){
        if(this.$cookies.get("token")){
			this.$router.push({path: '/'});
		}
	}
}
</script>