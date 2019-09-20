<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Salary</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Pay Salary
          <router-link to="/employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="salaryPaid">
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
                  <div class="form-group">
                    <select
                      class="form-control"
                      id="exampleFormControlSelect1"
                      v-model="form.salary_month"
                    >
                      <option>Please Select Month</option>
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
                  </div>
                  <small class="text-danger" v-if="errors.salary_month">{{errors.salary_month[0]}}</small>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input
                        type="text"
                        id="email"
                        class="form-control"
                        placeholder="Email address"
                        v-model="form.salary"
                      />
                      <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>
                      <label for="salary">Salary</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  mounted() {
    if (!User.loggedIn()) {
      this.$router.push({
        name: "/"
      });
    }
  },
  data() {
    return {
      form: {
        name: "",
        email: "",
        salary: "",
        salary_month: ""
      },
      errors: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/employee/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    salaryPaid() {
      let id = this.$route.params.id;
      axios
        .post("/api/salary/paid/" + id, this.form)
        .then(res => {
          if (res.data == "Salary Already Paid") {
            Notification.error("Salary Already Paid");
          } else {
            this.$router.push({ name: "given-salary" });
            Notification.success();
          }
        })
        .catch(error => (this.errors = error.response.data.error));
    }
  }
};
</script>
<style type="text/css">
.btn-sm,
.btn-group-sm > .btn {
  float: right;
}
</style>
