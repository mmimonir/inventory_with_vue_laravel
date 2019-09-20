<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">All Product</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Product
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
                  <th>Code</th>
                  <th>Category</th>
                  <th>Buying Price</th>
                  <th>Status</th>
                  <th>Quantity</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in filtersearch" :key="product.id">
                  <td>{{product.product_name}}</td>
                  <td>{{product.product_code}}</td>
                  <td>{{product.category_name}}</td>
                  <td>{{product.buying_price}}</td>
                  <td v-if="product.product_quantity >=1">
                    <span class="badge badge-success">Available</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-danger">Stock Out</span>
                  </td>
                  <td>{{product.product_quantity}}</td>
                  <td>
                    <img :src="product.image" id="em_photo" />
                  </td>
                  <td>
                    <router-link
                      :to="{name:'edit-stock', params:{id: product.id}}"
                      class="btn btn-sm btn-info"
                    >Edit</router-link>
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
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
      products: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.products.filter(product => {
        return product.product_name.match(this.searchTerm);
      });
    }
  },
  methods: {
    allProduct() {
      axios
        .get("/api/product/")
        .then(({ data }) => (this.products = data))
        .catch();
    }
  },
  created() {
    this.allProduct();
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
