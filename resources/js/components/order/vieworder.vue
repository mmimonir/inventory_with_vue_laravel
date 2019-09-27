<template>
  <div>
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Order Details</li>
    </ol>
    <!-- Icon Cards-->
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Order
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <p class="list-group-item bg-info text-white text-center">
                <strong>Customer Details</strong>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-6">
              <ul class="list-group">
                <li class="list-group-item">
                  <strong>Name:</strong>
                  {{ orders.name }}
                </li>
                <li class="list-group-item">
                  <strong>Phone:</strong>
                  {{ orders.phone }}
                </li>
                <li class="list-group-item">
                  <strong>Address:</strong>
                  {{ orders.address }}
                </li>
                <li class="list-group-item">
                  <strong>Date :</strong>
                  {{ orders.order_date }}
                </li>
                <li class="list-group-item">
                  <strong>Quantity:</strong>
                  {{ orders.qty }}
                </li>
                <li class="list-group-item">
                  <strong>Sub Total:</strong>
                  {{ orders.sub_total }}
                </li>
              </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-6">
              <ul class="list-group">
                <li class="list-group-item">
                  <strong>Vat:</strong>
                  {{ orders.vat }} %
                </li>
                <li class="list-group-item">
                  <strong>Total:</strong>
                  {{ orders.total }}
                </li>
                <li class="list-group-item">
                  <strong>Pay:</strong>
                  {{ orders.pay }}
                </li>
                <li class="list-group-item">
                  <strong>Due:</strong>
                  {{ orders.due }}
                </li>
                <li class="list-group-item">
                  <strong>Pay Through:</strong>
                  {{ orders.payby }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="row container">
      <div class="card col-lg-12">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Order Details
        </div>
        <div class="card-body">
          <div class="row">
            <div class="table-responsive">
              <label>Search</label>
              <br />
              <table class="table table-bordered" id width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="detail in details" :key="detail.id">
                    <td>{{ detail.product_name }}</td>
                    <td>{{ detail.product_code }}</td>
                    <td>
                      <img :src="'/'+detail.image" id="em_photo" />
                    </td>
                    <td>{{ detail.pro_quantity }}</td>
                    <td>{{ detail.product_price }}</td>
                    <td>{{ detail.sub_total }}</td>
                  </tr>
                  <tr>
                    <td>Grand Total</td>
                    <td></td>
                    <td></td>
                    <td>{{ orders.qty }}</td>
                    <td></td>
                    <td>{{ orders.total }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
      errors: {},
      orders: {},
      details: {}
    };
  },
  created() {
    let id = this.$route.params.id;
    axios
      .get("/api/order/details/" + id)
      .then(({ data }) => (this.orders = data))
      .catch(error => (this.errors = error.response.data.error));
    axios
      .get("/api/order/orderdetails/" + id)
      .then(({ data }) => (this.details = data))
      .catch(error => (this.errors = error.response.data.error));
  },
  methods: {}
};
</script>
<style type="text/css">
.btn-sm,
.btn-group-sm > .btn {
  float: right;
}
</style>
