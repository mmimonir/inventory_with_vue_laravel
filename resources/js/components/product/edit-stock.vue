<template>
  <div>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">Product</li>
    </ol>
    <div class="container">
      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Product Stock Update
        </div>
        <div class="card-body">
          <form @submit.prevent="stockUpdate">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-label-group">
                    <input
                      type="text"
                      id="product_quantity"
                      class="form-control"
                      placeholder="Quantity"
                      v-model="form.product_quantity"
                    />
                    <small
                      class="text-danger"
                      v-if="errors.product_quantity"
                    >{{errors.product_quantity[0]}}</small>
                    <label for="product_quantity">Quantity</label>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Stock Update</button>
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
        product_quantity: ""
      },
      errors: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/product/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
  },
  methods: {
    stockUpdate() {
      let id = this.$route.params.id;
      axios
        .post("/api/stock/update/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "stock" });
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
