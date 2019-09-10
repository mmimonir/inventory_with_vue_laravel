<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">All Suppliers</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Supplier Insert
          <router-link to="/store-supplier" class="btn btn-sm btn-info" id="add_new">Add New</router-link>
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
                  <th>Address</th>
                  <th>Shop Name</th>
                  <th>Phone</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="supplier in filtersearch" :key="supplier.id">
                  <td>{{supplier.name}}</td>
                  <td>{{supplier.email}}</td>
                  <td>{{supplier.address}}</td>
                  <td>{{supplier.shopname}}</td>
                  <td>{{supplier.phone}}</td>
                  <td>
                    <img :src="supplier.photo" id="em_photo" />
                  </td>
                  <td>
                    <router-link
                      :to="{name:'edit-supplier', params:{id: supplier.id}}"
                      class="btn btn-sm btn-info"
                    >Edit</router-link>
                    <a class="btn btn-sm btn-danger" @click="deleteSupplier(supplier.id)">Delete</a>
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
      suppliers: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.suppliers.filter(supplier => {
        return supplier.name.match(this.searchTerm);
      });
    }
  },
  methods: {
    allSupplier() {
      axios
        .get("/api/supplier/")
        .then(({ data }) => (this.suppliers = data))
        .catch();
    },
    deleteSupplier(id, photo) {
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
            .delete("/api/supplier/" + id)
            .then(() => {
              this.suppliers = this.suppliers.filter(supplier => {
                return supplier.id != id;
              });
            })
            .catch(() => {
              this.$router.push({ name: "supplier" });
            });
          Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
      });
    }
  },
  created() {
    this.allSupplier();
    console.log(this.suppliers);
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
