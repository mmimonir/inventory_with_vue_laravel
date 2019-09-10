<template></template>
<script type="text/javascript">
export default {
  created() {
    // User.logout();
    localStorage.removeItem("token");
    localStorage.removeItem("user");

    Toast.fire({
      type: "success",
      title: "Logout successfull"
    });
    this.$router.push({ name: "/" });
  }
};
</script>
<style type="text/css">
</style>