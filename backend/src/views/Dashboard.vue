<template>
  <div class="mb-2 flex items-center justify-between ">
    <h1 class="text-3xl font-semibold">Dashboard</h1>
    <div class="flex items-center">
      <label class="mr-2">Change Date Period</label>
      <CustomInput type="select" v-model="chosenDate" @change="onDatePickerChange" :select-options="dateOptions" />
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
    <!-- Active Customers-->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center">
      <label class="text-lg font-semibold block mb-2">Active Customers</label>
      <template v-if="!loading.customersCount">
        <span class="text-3xl font-semibold">{{ customersCount }}</span>
      </template>
      <Spinner v-else text="" class="py-2" />
    </div>
    <!-- /Active Customers-->

    <!-- Active Products-->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
      style="animation-delay: 0.1s">
      <label class="text-lg font-semibold block mb-2">Active Products</label>
      <template v-if="!loading.productsCount">
        <span class="text-3xl font-semibold">{{ productsCount }}</span>
      </template>
      <Spinner v-else text="" class="py-2" />
    </div>
    <!-- /Active Products-->

    <!-- Paid Orders-->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-center"
      style="animation-delay: 0.2s">
      <label class="text-lg font-semibold block mb-2">Paid Orders</label>
      <template v-if="!loading.paidOrders">
        <span class="text-3xl font-semibold">{{ paidOrders }}</span>
      </template>
      <Spinner v-else text="" class="py-2" />
    </div>
    <!-- /Paid Orders-->

    <!-- Total Income-->
    <div class="animate-fade-in-down bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center">
      <label class="text-lg font-semibold block mb-2">Total Income</label>
      <template v-if="!loading.totalIncome">
        <span class="text-3xl font-semibold">{{ totalIncome }}</span>
      </template>
      <Spinner v-else text="" class="py-2" />
    </div>
    <!-- /Total Income-->
  </div>

  <div class="grid grid-row-2 grid-flow-col grid-cols-1 md:grid-cols-3 gap-3" style="animation-delay: 0.3s">
    <div class="col-span-2 row-span-2 bg-white py-6 px-5 rounded-lg shadow ">
      <label class="text-lg font-semibold block mb-4">Latest Orders</label>
      <template v-if="!loading.latestOrders">
        <div v-for="o of latestOrders" :key="o.id" class="py-2 px-3 hover:bg-gray-50">
          <p>
            <router-link :to="{ name: 'app.orders.view', params: { id: o.id } }" class="text-indigo-700 font-semibold">
              Order #{{ o.id }}
            </router-link>
            created {{ o.created_at }}. {{ o.items }} items
          </p>
          <p class="flex justify-between">
            <span>{{ o.first_name }} {{ o.last_name }}</span>
            <span>{{ $filters.currencyINR(o.total_price) }}
            </span>
          </p>
        </div>
      </template>
      <Spinner v-else text="" class="" />
    </div>

    <div class="bg-white py-6 px-5 rounded-lg shadow flex flex-col items-center justify-start h-80">
      <label class="text-lg font-semibold block mb-4">Orders by Country</label>
      <template v-if="!loading.ordersByCountry">
        <DoughnutChart :width="160" :height="180" :data="ordersByCountry" />
      </template>
      <Spinner v-else text="" class="h-24" />
    </div>

    <div class="bg-white py-6 px-5 rounded-lg shadow">
      <label class="text-lg font-semibold block mb-2">Latest Customers</label>
      <template v-if="!loading.latestCustomers">
        <router-link :to="{ name: 'app.customers.view', params: { id: c.id } }" v-for="c of latestCustomers" :key="c.id"
          class="mb-3 flex">
          <div class="w-12 h-12 bg-gray-200 flex items-center justify-center rounded-full mr-2">
            <UserIcon class="w-5" />
          </div>
          <div>
            <h3>{{ c.first_name }} {{ c.last_name }}</h3>
            <p>{{ c.email }}</p>
          </div>
        </router-link>
      </template>
      <Spinner v-else text="" class="" />
    </div>
  </div>

</template>

<script setup>
import {UserIcon} from '@heroicons/vue/outline'
import DoughnutChart from '../components/core/Charts/Doughnut.vue'
import axiosClient from "../axios.js";
import {computed, onMounted, ref} from "vue";
import Spinner from "../components/core/Spinner.vue";
import CustomInput from "../components/core/CustomInput.vue";
import {useStore} from "vuex";


const store = useStore();
const dateOptions = computed(() => store.state.dateOptions);
const chosenDate = ref('all')


const loading = ref({
  customersCount: true,
  productsCount: true,
  paidOrders: true,
  totalIncome: true,
  ordersByCountry: true,
  latestCustomers: true,
  latestOrders: true
});
const customersCount = ref(0);
const productsCount = ref(0);
const paidOrders = ref(0);
const totalIncome = ref(0);
const ordersByCountry = ref([]);
const latestCustomers = ref([]);
const latestOrders = ref([]);




function updateDashboard() {
 const d = chosenDate.value
  loading.value = {
    customersCount: true,
    productsCount: true,
    paidOrders: true,
    totalIncome: true,
    ordersByCountry: true,
    latestCustomers: true,
    latestOrders: true
  }

  axiosClient.get(`/dashboard/customers-count`,{params:{d}}).then(({ data }) => {
    customersCount.value = data;
    loading.value.customersCount = false;
  });

  axiosClient.get(`/dashboard/products-count`,{params:{d}}).then(({ data }) => {
    productsCount.value = data;
    loading.value.productsCount = false;
  });

  axiosClient.get(`/dashboard/oders-count`,{params:{d}}).then(({ data }) => {
    paidOrders.value = data;
    loading.value.paidOrders = false;
  });

  axiosClient.get(`/dashboard/income-amount`,{params:{d}}).then(({ data }) => {
    totalIncome.value = new Intl.NumberFormat('en-IN', { 
      style: 'currency', 
      currency: 'INR',
      minimumFractionDigits: 0
      })
      .format(data);
    loading.value.totalIncome = false;
  });

  axiosClient.get(`/dashboard/orders-by-country`,{params:{d}}).then(({ data }) => {
    loading.value.ordersByCountry = false;

    const chartData = {
      labels: [],
      datasets: [{
        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
        data: []
      }]
    };

    data.forEach(c => {
      chartData.labels.push(c.name);
      chartData.datasets[0].data.push(c.count);
    });


    ordersByCountry.value = chartData;
  });

  axiosClient.get(`/dashboard/latest-customers`,{params:{d}}).then(({ data: customers }) => {
    latestCustomers.value = customers;
    loading.value.latestCustomers = false;
  })

  axiosClient.get(`/dashboard/latest-orders`,{params:{d}}).then(({ data: orders }) => {
    latestOrders.value = orders.data;
    loading.value.latestOrders = false;
  })
}

function onDatePickerChange() {
  updateDashboard()
}

onMounted(() => updateDashboard())
</script>

<style scoped></style>
