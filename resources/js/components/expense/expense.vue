<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">All Expense</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Expense Insert
          <router-link to="/store-expense" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <label id="search">
              Search:
              <input
                type="text"
                v-model="searchTerm"
                class="form-control"
                style="width:200px; display:inline;"
              />
            </label>

            <br />
            <br />
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="expense in filtersearch" :key="expense.id">
                  <td>{{expense.details}}</td>
                  <td>{{expense.amount}}</td>
                  <td>{{expense.expense_date}}</td>
                  <td>
                    <router-link
                      :to="{name:'edit-expense', params:{id: expense.id}}"
                      class="btn btn-sm btn-info"
                    >Edit</router-link>
                    <a class="btn btn-sm btn-danger" @click="deleteExpense(expense.id)">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
      expenses: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.expenses.filter(category => {
        return category.expense_date.match(this.searchTerm);
      });
    }
  },
  methods: {
    allExpense() {
      axios
        .get("/api/expense/")
        .then(({ data }) => (this.expenses = data))
        .catch();
    },
    deleteExpense(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          axios
            .delete("/api/expense/" + id)
            .then(() => {
              this.expenses = this.expenses.filter(category => {
                return category.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "expense" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.allExpense();
    console.log(this.expenses);
  }
};
</script>
<style type="text/css">
.btn-sm,
.btn-group-sm > .btn {
  float: right;
}
#em_photo {
  height: 40px;
  width: 40px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}
#search {
  position: absolute;
  right: 20px;
}
</style>
