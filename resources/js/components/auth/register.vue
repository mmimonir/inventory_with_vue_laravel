<template>
  <div>
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
          <form @submit.prevent="signup">
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="name"
                  class="form-control"
                  placeholder="Full name"
                  v-model="form.name"
                />
                <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                <label for="name">Full name</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="Email address"
                  v-model="form.email"
                />
                <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                <label for="email">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="password"
                      id="inputPassword"
                      class="form-control"
                      placeholder="Password"
                      v-model="form.password"
                    />
                    <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                    <label for="inputPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="password"
                      id="confirmPassword"
                      class="form-control"
                      placeholder="Confirm password"
                      v-model="form.password_confirmation"
                    />
                    <label for="confirmPassword">Confirm password</label>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </form>
          <div class="text-center">
            <router-link class="d-block small mt-3" to="/">Already have an Account</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  created() {
    if (User.loggedIn()) {
      this.$router.push({ name: "home" });
    }
  },
  data() {
    return {
      form: {
        name: null,
        email: null,
        password: null,
        confirm_password: null
      },
      errors: {}
    };
  },
  methods: {
    signup() {
      axios
        .post("/api/auth/signup", this.form)
        .then(res => {
          User.responseAfterLogin(res);
          Toast.fire({
            type: "success",
            title: "Signup in successfully"
          });
          this.$router.push({ name: "home" });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    },
    errorHide() {
      this.errors = {};
    }
  }
};
</script>
<style type="text/css">
</style>