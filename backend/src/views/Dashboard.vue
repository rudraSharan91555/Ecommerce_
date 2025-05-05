<template>
  <h1 class="text-3xl font-semibold">Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">

<!-- Active Customers-->
<div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
  <label>Active Customers</label>
  <template v-if="!loading.customersCount">
    <span class="text-3xl font-semibold ">{{customersCount}}</span>
  </template>
  <Spinner v-else text="" class="py-2"/>
</div>
 <!-- /Active Customers-->

 <!-- Active Products-->
<div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
  <label>Active Products</label>
  <template v-if="!loading.productsCount">
    <span class="text-3xl font-semibold ">{{productsCount}}</span>
  </template>
  <Spinner v-else text="" class="py-2" />
</div>
 <!-- /Active Products-->

<!-- Paid Orders-->
<div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
    <label>Paid Orders</label>
    <template v-if="!loading.paidOrders">
      <span class="text-3xl font-semibold ">{{paidOrders}}</span>
    </template>
    <Spinner v-else text="" class="py-2" />
</div>
 <!-- /Paid Orders-->

 <!-- Total Income-->
<div class=" bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center ">
  <label>Total Income</label>
  <template v-if="!loading.totalIncome">
    <span class="text-3xl font-semibold ">{{totalIncome}}</span>
  </template>
  <Spinner v-else text="" class="py-2" />
</div>
 <!-- /Total Income-->
</div>

<div class="grid grid-row-2 grid-flow-col  grid-cols-1 md:grid-cols-3 gap-3 ">
  <div class="col-span-2 row-span-2 bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
  Product
  </div>
  <div class="bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
    <DoughnutChart :width="140" :height="200" />
  </div>
  <div class="bg-white py-6 px-5  rounded-lg shadow flex flex-col items-center justify-center">
    Customers
  </div>
</div>
</template>

<script setup>
import DoughnutChart from '../components/core/Charts/Doughnut.vue'
import axiosClient from "../axios.js";
import { ref } from 'vue';
import Spinner from '../components/core/Spinner.vue';

const loading = ref({
  customersCount: true,
  productsCount: true,
  paidOrders: true,
  totalIncome: true
});
const customersCount = ref(0);
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);

axiosClient.get(`/dashboard/customers-count`).then(({data})=> {
  customersCount.value = data;
  loading.value.customersCount = false;
})
axiosClient.get(`/dashboard/products-count`).then(({data})=>{
  productsCount.value = data;
  loading.value.productsCount = false;
})
axiosClient.get(`/dashboard/oders-count`).then(({data})=>{
  paidOrders.value = data;
  loading.value.paidOrders = false;
})
axiosClient.get(`/dashboard/income-amount`).then(({data})=> {
  totalIncome.value = new Intl.NumberFormat('en-IN', {style: 'currency',currency: 'INR'})
  .format(data);
  loading.value.totalIncome = false;
})

</script>

<style scoped></style>