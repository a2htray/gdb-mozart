<template>
  <v-card class="elevation-12">
    <v-toolbar dark color="primary">
      <v-toolbar-title>{{ title }}</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <v-form ref="form">
        <v-text-field
          prepend-icon="person"
          name="identify"
          label="username or email" type="text"
          required
          v-model="md.identify"
          :rules="[ validateIdentify ]"
        >
        </v-text-field>
        <v-text-field
          id="password"
          prepend-icon="lock"
          name="password"
          label="Password"
          type="password"
          required
          v-model="md.password"
          :rules="[ validatePassword ]"
        >
        </v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="submit">Login</v-btn>
      <v-btn color="primary">Reset</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
  import { validateUsername, validatePassword as validatePasswordUtil, validateEmail } from '../util'
  import axios from 'axios'
  export default {
    data: () => {
      return {
        md: {
          loginType: 1,
          // development mock
          identify: 'mozart',
          password: 'mozart',
//          identify: '',
//          password: '',
        },
      }
    },
    props: {
      title: String,
    },
    methods: {
      validateIdentify(v) {
        if (!v) {
          return 'Username or email is required'
        }
        
        if (validateEmail(v)) {
          this.md.loginType = 2;
          return true;
        }
        
        if (validateUsername(v)) {
          this.md.loginType = 1;
          return true
        }
        
        return 'Username or email must be valid'
      },
      validatePassword(v) {
        if (!v) {
          return 'Password is required'
        }
        
        return validatePasswordUtil(v) || 'Password must be valid'
      },
      submit() {
        if (this.$refs.form.validate()) {
          let params = {
            password: this.md.password,
            loginType: this.md.loginType,
          };
          if (this.md.loginType === 1) {
            params.username = this.md.identify
          } else {
            params.email = this.md.identify;
          }
          this.$NProgress.start()
          axios.post('/api/login', params).then((res) => {
            if (res.data.code === 200) {
              const data = res.data.data
              window.location.href = 'http://develop-package/u/' + data.name + '/dashboard?token=' + data.token
            } else {
              console.warn('Give you warning message bellow')
              console.table(res.data)
            }
            this.$NProgress.done()
          })
        }
      }
    },
    mounted () {
    }
  }
</script>
