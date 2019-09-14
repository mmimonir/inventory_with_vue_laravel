<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i> Category Update
          <router-link to="/category" class="btn btn-sm btn-info" id="add_new">All Category</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="categoryUpdate">
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="category_name"
                  class="form-control"
                  placeholder="Category Name"
                  v-model="form.category_name"
                />
                <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>
                <label for="name">Category Name</label>
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
        category_name: ""
      },
      errors: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/category/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    categoryUpdate() {
      let id = this.$route.params.id;
      axios
        .patch("/api/category/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "category" });
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
