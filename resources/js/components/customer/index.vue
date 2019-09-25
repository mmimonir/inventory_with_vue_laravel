<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">All Customer</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Customer
          <router-link to="/store-customer" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
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
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="customer in filtersearch" :key="customer.id">
                  <td>{{customer.name}}</td>
                  <td>{{customer.email}}</td>
                  <td>{{customer.phone}}</td>
                  <td>
                    <img :src="customer.photo" id="em_photo" />
                  </td>
                  <td>
                    <router-link
                      :to="{name:'edit-customer', params:{id: customer.id}}"
                      class="btn btn-sm btn-info"
                    >Edit</router-link>
                    <a class="btn btn-sm btn-danger" @click="deleteCustomer(customer.id)">Delete</a>
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
      customers: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.customers.filter(employee => {
        return employee.name.match(this.searchTerm);
      });
    }
  },
  methods: {
    allCustomer() {
      axios
        .get("/api/customer/")
        .then(({ data }) => (this.customers = data))
        .catch();
    },
    deleteCustomer(id, photo) {
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
            .delete("/api/customer/" + id)
            .then(() => {
              this.customers = this.customers.filter(customer => {
                return customer.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "customer" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.allCustomer();
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
