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
          <i class="fas fa-chart-area"></i> Product Update
          <router-link to="/product" class="btn btn-sm btn-info" id="add_new">All Product</router-link>
        </div>
        <div class="card-body">
          <form @submit.prevent="productUpdate" enctype="multipart/form-data">
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="product_name"
                  class="form-control"
                  placeholder="Full product_name"
                  v-model="form.product_name"
                />
                <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small>
                <label for="product_name">Product Name</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input
                  type="text"
                  id="product_code"
                  class="form-control"
                  placeholder="Product Code"
                  v-model="form.product_code"
                />
                <small class="text-danger" v-if="errors.product_code">{{errors.product_code[0]}}</small>
                <label for="product_code">Product Code</label>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Category</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect1"
                    v-model="form.category_id"
                  >
                    <option
                      v-for="category in categories"
                      :value="category.id"
                      :key="category.id"
                    >{{category.category_name}}</option>
                  </select>
                </div>
                <small class="text-danger" v-if="errors.category_id">{{errors.category_id[0]}}</small>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Supplier</label>
                  <select
                    class="form-control"
                    id="exampleFormControlSelect1"
                    v-model="form.supplier_id"
                  >
                    <option
                      v-for="supplier in suppliers"
                      :key="supplier.id"
                      :value="supplier.id"
                    >{{supplier.name}}</option>
                  </select>
                  <small class="text-danger" v-if="errors.supplier_id">{{errors.supplier_id[0]}}</small>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input
                    type="text"
                    id="root"
                    class="form-control"
                    placeholder="Root"
                    v-model="form.root"
                  />
                  <small class="text-danger" v-if="errors.root">{{errors.root[0]}}</small>
                  <label for="root">Root</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input
                    type="text"
                    id="buying_price"
                    class="form-control"
                    placeholder="Buying Price"
                    v-model="form.buying_price"
                  />
                  <small class="text-danger" v-if="errors.buying_price">{{errors.buying_price[0]}}</small>
                  <label for="buying_price">Buying Price</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input
                    type="text"
                    id="selling_price"
                    class="form-control"
                    placeholder="Selling Price"
                    v-model="form.selling_price"
                  />
                  <small class="text-danger" v-if="errors.selling_price">{{errors.selling_price[0]}}</small>
                  <label for="selling_price">Selling Price</label>
                </div>
              </div>
            </div>
            <br />
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input
                    type="date"
                    id="buying_date"
                    class="form-control"
                    placeholder="dd/mm/yyyy"
                    v-model="form.buying_date"
                  />
                  <small class="text-danger" v-if="errors.buying_date">{{errors.buying_date[0]}}</small>
                  <label for="buying_date">Buying Date</label>
                </div>
              </div>
              <div class="col-md-6">
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
            <div class="form-group">
              <div class="form-label-group">
                <input type="file" class="form-control" @change="onFileSelected" />
                <small class="text-danger" v-if="errors.image">{{errors.image[0]}}</small>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <img class="img-fluid img-thumbnail" :src="form.image" />
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
        product_name: "",
        product_code: "",
        category_id: "",
        supplier_id: "",
        root: "",
        buying_price: "",
        selling_price: "",
        buying_date: "",
        image: "",
        product_quantity: "",
        new_image: ""
      },
      errors: {},
      categories: {},
      suppliers: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/product/" + id)
      .then(({ data }) => (this.form = data))
      .catch(console.log("error"));
    axios
      .get("/api/category/")
      .then(({ data }) => (this.categories = data))
      .catch(error => (this.errors = error.response.data.error));
    axios
      .get("/api/supplier/")
      .then(({ data }) => (this.suppliers = data))
      .catch(error => (this.errors = error.response.data.error));
  },
  methods: {
    onFileSelected(e) {
      let file = e.target.files[0];
      if (file.size > 1048770) {
        Notification.image_validation();
      } else {
        let reader = new FileReader();
        reader.onload = event => {
          this.form.new_image = event.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    productUpdate() {
      let id = this.$route.params.id;
      axios
        .patch("/api/product/" + id, this.form)
        .then(() => {
          this.$router.push({ name: "product" });
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
