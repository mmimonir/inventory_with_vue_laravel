<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Expense</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Expense Update
          <router-link to="/expense" class="btn btn-sm btn-info" id="add_new">All Expense</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="expenseUpdate">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description of Expenses</label>
                    <textarea
                      class="form-control"
                      id="exampleFormControlTextarea1"
                      rows="3"
                      v-model="form.details"
                    ></textarea>
                    <small class="text-danger" v-if="errors.details">{{errors.details[0]}}</small>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input
                        type="text"
                        id="amount"
                        class="form-control"
                        placeholder="Category Name"
                        v-model="form.amount"
                      />
                      <small class="text-danger" v-if="errors.amount">{{errors.amount[0]}}</small>
                      <label for="amount">Amount</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <input
                        type="date"
                        id="amount"
                        class="form-control"
                        placeholder="Category Name"
                        v-model="form.expense_date"
                      />
                      <small
                        class="text-danger"
                        v-if="errors.expense_date"
                      >{{errors.expense_date[0]}}</small>
                      <label for="amount">Date</label>
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
        details: "",
        amount: "",
        expense_date: ""
      },
      errors: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/expense/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    expenseUpdate() {
      let id = this.$route.params.id;
      axios
        .patch("/api/expense/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "expense" });
          Notification.success();
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
