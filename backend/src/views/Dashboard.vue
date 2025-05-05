<template>
      <h1 class="text-3xl font-semibold">Dashboard</h1>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">

    <!-- Active Customers-->
    <div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
      <label>Active Customers</label>
      <span class="text-3xl font-semibold ">15</span>
    </div>
     <!-- /Active Customers-->

     <!-- Active Products-->
    <div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
      <label>Active Products</label>
      <span class="text-3xl font-semibold ">28</span>
    </div>
     <!-- /Active Products-->

    <!-- Paid Orders-->
    <div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
      <label>Paid Orders</label>
      <span class="text-3xl font-semibold ">28</span>
    </div>
     <!-- /Paid Orders-->

     <!-- Total Income-->
    <div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center ">
      <label>Total Income</label>
      <span class="text-3xl font-semibold ">₹28,026</span>
    </div>
     <!-- /Total Income-->
  </div>

  <div>
    <DoughnutChart />
  </div>
</template>

<script setup>
import Doughnut from '../components/core/Charts/Doughnut.vue';
import DoughnutChart from '../components/core/Charts/Doughnut.vue'


</script>

<style scoped></style>
