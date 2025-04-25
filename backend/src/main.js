// import { createApp } from 'vue'
// import store from './store';
// import './index.css';
// import router from './router';

// import App from './App.vue'

// createApp(App).use(store).use(router).mount('#app')


import { createApp } from 'vue'
import store from './store';
import './index.css';
import router from './router';

import App from './App.vue'

const app = createApp(App)

// Global currency filter/function
app.config.globalProperties.$filters = {
  currencyINR(value) {
    if (!value) return '₹0.00';
    return new Intl.NumberFormat('en-IN', {
      style: 'currency',
      currency: 'INR',
    }).format(value);
  }
}

app.use(store).use(router).mount('#app')
