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
          <i class="fas fa-chart-area"></i> Employee
          <router-link to="/store-employee" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
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
                  <th>Phone</th>
                  <th>Salary</th>
                  <th>Joining Date</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="employee in filtersearch" :key="employee.id">
                  <td>{{employee.name}}</td>
                  <td>{{employee.phone}}</td>
                  <td>{{employee.salary}}</td>
                  <td>{{employee.date|formatDate}}</td>
                  <td>
                    <img :src="employee.photo" id="em_photo" />
                  </td>
                  <td>
                    <router-link
                      :to="{name:'edit-employee', params:{id: employee.id}}"
                      class="btn btn-sm btn-info"
                    >Edit</router-link>
                    <a class="btn btn-sm btn-danger" @click="deleteEmployee(employee.id)">Delete</a>
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
      employees: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.employees.filter(employee => {
        return employee.phone.match(this.searchTerm);
      });
    }
  },
  methods: {
    allEmployee() {
      axios
        .get("/api/employee/")
        .then(({ data }) => (this.employees = data))
        .catch();
    },
    deleteEmployee(id, photo) {
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
            .delete("/api/employee/" + id)
            .then(() => {
              this.employees = this.employees.filter(employee => {
                return employee.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "employee" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.allEmployee();
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
