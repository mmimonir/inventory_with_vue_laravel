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
          <i class="fas fa-chart-area"></i>
          Salary Update
        </div>
        <div class="card-body">
          <form @submit.prevent="salaryUpdate">
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
                <input type="hidden" v-model="form.employee_id" />
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input
                        type="text"
                        id="email"
                        class="form-control"
                        placeholder="Email address"
                        v-model="form.amount"
                      />
                      <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                      <label for="amount">Salary</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Update</button>
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
        amount: "",
        salary_month: "",
        employee_id: ""
      },
      errors: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    console.log(id);
    axios
      .get("/api/edit/salary/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    salaryUpdate() {
      let id = this.$route.params.id;
      // console.log(this.form);
      axios
        .post("/api/salary/update/" + id, this.form)
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
