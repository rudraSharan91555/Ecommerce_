<template>
  <BarChart :data="chartData" :height="240" />
</template>

<script setup>
import axiosClient from "../../axios.js";
import { ref, watch } from "vue";
import BarChart from "../../components/core/Charts/Bar.vue";
import { useRoute } from "vue-router";

const route = useRoute();


const chartData = ref({
  labels: [],
  datasets: []
});

watch(route, (rt) => {
  console.log(rt.params.date)
  getData();
}, { immediate: true });

function getData() {
  axiosClient.get('report/orders', { params: { d: route.params.date } })
    .then(({ data }) => {
      
      chartData.value = {
        labels: data.labels || [],
        datasets: data.datasets || []
      };
    })
    .catch((error) => {
      console.error('Error fetching chart data:', error);
    });
}
</script>
