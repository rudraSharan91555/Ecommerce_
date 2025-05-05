

<script setup>
import { Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement, CategoryScale } from 'chart.js'


ChartJS.register(Title, Tooltip, Legend, ArcElement, CategoryScale)


const data = {
  labels: ['VueJs', 'EmberJs', 'ReactJs', 'AngularJs'],
  datasets: [
    {
      backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
      data: [40, 20, 80, 10]
    }
  ]
}

const options = {
  responsive: true,
  maintainAspectRatio: false
}
</script>

<template>
  <Doughnut :data="data" :options="options" />
</template>

<style scoped>
/* Optional CSS for chart container */
canvas {
  display: block;
  margin: 0 auto;
}
</style>

