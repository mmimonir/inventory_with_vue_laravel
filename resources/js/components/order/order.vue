<template>
  <div>
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Today Order</li>
      </ol>

      <div class="card mx-auto mt-5" style="width: 80%;">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Order Table
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
                  <th>Total Amount</th>
                  <th>Pay</th>
                  <th>Due</th>
                  <th>PayBy</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in filtersearch" :key="order.id">
                  <td>{{order.name}}</td>
                  <td>{{order.total}}</td>
                  <td>{{order.pay}}</td>
                  <td>{{order.due}}</td>
                  <td>{{order.payby}}</td>
                  <td>
                    <router-link
                      :to="{name:'view-order', params:{id: order
                     .id}}"
                      class="btn btn-sm btn-info"
                    >View</router-link>
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
      orders: [],
      searchTerm: ""
    };
  },
  computed: {
    filtersearch() {
      return this.orders.filter(order => {
        return order.name.match(this.searchTerm);
      });
    }
  },
  methods: {
    allOrder() {
      axios
        .get("/api/orders/")
        .then(({ data }) => (this.orders = data))
        .catch();
    }
  },
  created() {
    this.allOrder();
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
