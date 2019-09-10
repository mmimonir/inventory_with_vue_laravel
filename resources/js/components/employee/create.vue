<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Employee</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Employee Insert
          <router-link to="/employee" class="btn btn-sm btn-info" id="add_new">All Employee</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="employeeInsert" enctype="multipart/form-data">
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
                <input
                  type="text"
                  id="nid"
                  class="form-control"
                  placeholder="NID Number"
                  v-model="form.nid"
                />
                <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>
                <label for="nid">NID Number</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="salary"
                  class="form-control"
                  placeholder="NID Number"
                  v-model="form.salary"
                />
                <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>
                <label for="salary">Salary</label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input
                      type="date"
                      id="date"
                      class="form-control"
                      placeholder="dd/mm/yyyy"
                      v-model="form.date"
                    />
                    <small class="text-danger" v-if="errors.date">{{errors.date[0]}}</small>
                    <label for="date">Joining Date</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="file" class="form-control" @change="onFileSelected" />
                    <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
                  </div>
                </div>
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
        nid: "",
        salary: "",
        date: "",
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
    employeeInsert() {
      axios
        .post("/api/employee/", this.form)
        .then(() => {
          this.$router.push({ name: "employee" });
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
