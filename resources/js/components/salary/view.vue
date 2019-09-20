<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">All Employee</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Employee Salary Details
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
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="salary in filtersearch" :key="salary.id">
                  <td>{{salary.name}}</td>
                  <td>{{salary.salary_month}}</td>
                  <td>{{salary.amount}}</td>
                  <td>{{salary.salary_date}}</td>
                  <td>
                    <router-link
                      :to="{name:'edit-salary', params:{id: salary.id}}"
                      class="btn btn-sm btn-info"
                    >Edit Salary</router-link>
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
      salaries: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.salaries.filter(salary => {
        return salary.name.match(this.searchTerm);
      });
    }
  },
  methods: {
    viewSalary() {
      let id = this.$route.params.id;
      axios
        .get("/api/salary/view/" + id)
        .then(({ data }) => (this.salaries = data))
        .catch(error => (this.error = error.response.data.errors));
    }
  },
  created() {
    this.viewSalary();
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
