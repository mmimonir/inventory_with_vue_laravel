<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Customer</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Customer Insert
          <router-link to="/customer" class="btn btn-sm btn-info" id="add_new">All Customer</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="customerInsert" enctype="multipart/form-data">
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
              <div class="form-label-group">
                <input
                  type="text"
                  id="address"
                  class="form-control"
                  placeholder="Address"
                  v-model="form.address"
                />
                <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
                <label for="address">Address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="phone"
                  class="form-control"
                  placeholder="Address"
                  v-model="form.phone"
                />
                <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
                <label for="phone">Phone No</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="file" class="form-control" @change="onFileSelected" />
                <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <img class="img-fluid img-thumbnail" :src="form.photo" />
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script type="text/javascript">
export default {
  created() {
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
        address: "",
        photo: "",
        phone: ""
      },
      errors: {}
    };
  },
  methods: {
    onFileSelected(e) {
      let file = e.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = event => {
          this.form.photo = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    customerInsert() {
      axios
        .post("/api/customer/", this.form)
        .then(() => {
          this.$router.push({ name: "customer" });
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
