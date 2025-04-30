<!-- <template>
  <div v-if="customer.id" class="animate-fade-in-down">
    <form @submit.prevent="onSubmit">
      <div class="bg-white px-4 pt-5 pb-4">
        <h1 class="text-2xl font-semibold pb-2">{{ title }}</h1>
        <CustomInput class="mb-2" v-model="customer.first_name" label="First Name" :errors="errors.first_name"/>
        <CustomInput class="mb-2" v-model="customer.last_name" label="Last Name" :errors="errors.last_name"/>
        <CustomInput class="mb-2" v-model="customer.email" label="Email" :errors="errors.email"/>
        <CustomInput class="mb-2" v-model="customer.phone" label="Phone" :errors="errors.phone"/>
        <CustomInput type="checkbox" class="mb-2" v-model="customer.status" label="Active" :errors="errors.status"/>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Billing Address</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              <CustomInput v-model="customer.billingAddress.address1" label="Address 1" :errors="errors['billingAddress.address1']"/>
              <CustomInput v-model="customer.billingAddress.address2" label="Address 2" :errors="errors['billingAddress.address2']"/>
              <CustomInput v-model="customer.billingAddress.city" label="City" :errors="errors['billingAddress.city']"/>
              <CustomInput v-model="customer.billingAddress.zipcode" label="Zip Code" :errors="errors['billingAddress.zipcode']"/>
              <CustomInput v-model="customer.billingAddress.country" label="Country" :errors="errors['billingAddress.country']"/>
              <CustomInput v-if="!billingCountry || !billingCountry.states" v-model="customer.billingAddress.state" label="State" :errors="errors['billingAddress.state']"/>
            </div>
          </div>

          <div>
            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Shipping Address</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              <CustomInput v-model="customer.shippingAddress.address1" label="Address 1" :errors="errors['shippingAddress.address1']"/>
              <CustomInput v-model="customer.shippingAddress.address2" label="Address 2" :errors="errors['shippingAddress.address2']"/>
              <CustomInput v-model="customer.shippingAddress.city" label="City" :errors="errors['shippingAddress.city']"/>
              <CustomInput v-model="customer.shippingAddress.zipcode" label="Zip Code" :errors="errors['shippingAddress.zipcode']"/>
              <CustomInput v-model="customer.shippingAddress.country" label="Country" :errors="errors['shippingAddress.country']"/>
              <CustomInput v-if="!shippingCountry || !shippingCountry.states" v-model="customer.shippingAddress.state" label="State" :errors="errors['shippingAddress.state']"/>
            </div>
          </div>
        </div>
      </div>

      <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="submit" class="w-full sm:w-auto mt-3 sm:mt-0 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
          Submit
        </button>
        <router-link :to="{name: 'app.customers'}" class="w-full sm:w-auto mt-3 sm:mt-0 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import store from '../../store'
import CustomInput from '../../components/core/CustomInput.vue'

const route = useRoute()
const router = useRouter()

const title = ref('')
const loading = ref(false)

const customer = ref({
  id: null,
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  status: 'active', 
  billingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '', 
    state: ''
  },
  shippingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '',
    state: ''
  }
})

const errors = ref({})

const countries = computed(() => store.state.countries.map(c => ({ key: c.code, text: c.name })))

const billingCountry = computed(() => store.state.countries.find(c => c.name === customer.value.billingAddress.country))
const billingStateOptions = computed(() => billingCountry.value?.states ? Object.entries(billingCountry.value.states).map(([k, v]) => ({ key: k, text: v })) : [])

const shippingCountry = computed(() => store.state.countries.find(c => c.name === customer.value.shippingAddress.country))
const shippingStateOptions = computed(() => shippingCountry.value?.states ? Object.entries(shippingCountry.value.states).map(([k, v]) => ({ key: k, text: v })) : [])

function onSubmit() {
  loading.value = true

  customer.value.status = customer.value.status ? 'active' : 'disabled'

  const billingCountry = store.state.countries.find(c => c.name === customer.value.billingAddress.country)
  const shippingCountry = store.state.countries.find(c => c.name === customer.value.shippingAddress.country)

  customer.value.billingAddress.country_code = billingCountry ? billingCountry.code : ''
  customer.value.shippingAddress.country_code = shippingCountry ? shippingCountry.code : ''

  const action = customer.value.id ? 'updateCustomer' : 'createCustomer'

  store.dispatch(action, customer.value)
    .then(response => {
      loading.value = false
      if ([200, 201].includes(response.status)) {
        store.commit('showToast', `Customer successfully ${action === 'createCustomer' ? 'created' : 'updated'}`)
        store.dispatch('getCustomers')
        router.push({ name: 'app.customers' })
      }
    })
    .catch(err => {
      loading.value = false
      errors.value = err.response?.data?.errors || {}
    })
}

onMounted(() => {
  store.dispatch('getCountries').then(() => {
    store.dispatch('getCustomer', route.params.id)
      .then(({ data }) => {
        title.value = `Update customer: "${data.first_name} ${data.last_name}"`

        const billingCountry = store.state.countries.find(c => c.name === data.billingAddress.country)
        const shippingCountry = store.state.countries.find(c => c.name === data.shippingAddress.country)

        customer.value = {
          ...data,
          billingAddress: {
            ...data.billingAddress,
            country_code: billingCountry ? billingCountry.code : '',
            state: data.billingAddress.state || ''
          },
          shippingAddress: {
            ...data.shippingAddress,
            country_code: shippingCountry ? shippingCountry.code : '',
            state: data.shippingAddress.state || ''
          }
        }
      })
  })
})
</script> -->




<!-- <script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import store from '../../store'
import CustomInput from '../../components/core/CustomInput.vue'

const route = useRoute()
const router = useRouter()

const title = ref('')
const loading = ref(false)

const customer = ref({
  id: null,
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  status: 'active', // Default to 'active'
  billingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '', // Country code for backend
    state: ''
  },
  shippingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '', // Country code for backend
    state: ''
  }
})

const errors = ref({})

const countries = computed(() => store.state.countries.map(c => ({ key: c.code, text: c.name })))

const billingCountry = computed(() => store.state.countries.find(c => c.name === customer.value.billingAddress.country))
const shippingCountry = computed(() => store.state.countries.find(c => c.name === customer.value.shippingAddress.country))

const billingStateOptions = computed(() => billingCountry.value?.states ? Object.entries(billingCountry.value.states).map(([k, v]) => ({ key: k, text: v })) : [])
const shippingStateOptions = computed(() => shippingCountry.value?.states ? Object.entries(shippingCountry.value.states).map(([k, v]) => ({ key: k, text: v })) : [])

function onSubmit() {
  loading.value = true

  // Ensure status is a string
  customer.value.status = customer.value.status ? 'active' : 'disabled'

  // Map country name to country_code
  const billingCountryData = store.state.countries.find(c => c.name === customer.value.billingAddress.country)
  const shippingCountryData = store.state.countries.find(c => c.name === customer.value.shippingAddress.country)

  customer.value.billingAddress.country_code = billingCountryData ? billingCountryData.code : ''
  customer.value.shippingAddress.country_code = shippingCountryData ? shippingCountryData.code : ''

  const action = customer.value.id ? 'updateCustomer' : 'createCustomer'

  store.dispatch(action, customer.value)
    .then(response => {
      loading.value = false
      if ([200, 201].includes(response.status)) {
        store.commit('showToast', `Customer successfully ${action === 'createCustomer' ? 'created' : 'updated'}`)
        store.dispatch('getCustomers')
        router.push({ name: 'app.customers' })
      }
    })
    .catch(err => {
      loading.value = false
      errors.value = err.response?.data?.errors || {}
    })
}

onMounted(() => {
  store.dispatch('getCountries').then(() => {
    store.dispatch('getCustomer', route.params.id)
      .then(({ data }) => {
        title.value = `Update customer: "${data.first_name} ${data.last_name}"`

        const billingCountryData = store.state.countries.find(c => c.name === data.billingAddress.country)
        const shippingCountryData = store.state.countries.find(c => c.name === data.shippingAddress.country)

        customer.value = {
          ...data,
          billingAddress: {
            ...data.billingAddress,
            country_code: billingCountryData ? billingCountryData.code : '',
            state: data.billingAddress.state || ''
          },
          shippingAddress: {
            ...data.shippingAddress,
            country_code: shippingCountryData ? shippingCountryData.code : '',
            state: data.shippingAddress.state || ''
          }
        }
      })
  })
})
</script> -->



<template>
  <div v-if="customer.id !== null" class="animate-fade-in-down">
    <form @submit.prevent="onSubmit">
      <div class="bg-white px-4 pt-5 pb-4">
        <h1 class="text-2xl font-semibold pb-2">{{ title }}</h1>
        <CustomInput class="mb-2" v-model="customer.first_name" label="First Name" :errors="errors.first_name"/>
        <CustomInput class="mb-2" v-model="customer.last_name" label="Last Name" :errors="errors.last_name"/>
        <CustomInput class="mb-2" v-model="customer.email" label="Email" :errors="errors.email"/>
        <CustomInput class="mb-2" v-model="customer.phone" label="Phone" :errors="errors.phone"/>
        <CustomInput type="checkbox" class="mb-2" v-model="customer.status" label="Active" :errors="errors.status"/>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Billing Address -->
          <div>
            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Billing Address</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              <CustomInput v-model="customer.billingAddress.address1" label="Address 1" :errors="errors['billingAddress.address1']"/>
              <CustomInput v-model="customer.billingAddress.address2" label="Address 2" :errors="errors['billingAddress.address2']"/>
              <CustomInput v-model="customer.billingAddress.city" label="City" :errors="errors['billingAddress.city']"/>
              <CustomInput v-model="customer.billingAddress.zipcode" label="Zip Code" :errors="errors['billingAddress.zipcode']"/>

              <CustomInput
                :options="countries"
                v-model="customer.billingAddress.country_code"
                label="Country"
                :errors="errors['billingAddress.country_code']"
              />

              <CustomInput
                v-if="!billingCountry || !billingCountry.states"
                v-model="customer.billingAddress.state"
                label="State"
                :errors="errors['billingAddress.state']"
              />
            </div>
          </div>

          <!-- Shipping Address -->
          <div>
            <h2 class="text-xl font-semibold mt-6 pb-2 border-b border-gray-300">Shipping Address</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
              <CustomInput v-model="customer.shippingAddress.address1" label="Address 1" :errors="errors['shippingAddress.address1']"/>
              <CustomInput v-model="customer.shippingAddress.address2" label="Address 2" :errors="errors['shippingAddress.address2']"/>
              <CustomInput v-model="customer.shippingAddress.city" label="City" :errors="errors['shippingAddress.city']"/>
              <CustomInput v-model="customer.shippingAddress.zipcode" label="Zip Code" :errors="errors['shippingAddress.zipcode']"/>

              <CustomInput
                :options="countries"
                v-model="customer.shippingAddress.country_code"
                label="Country"
                :errors="errors['shippingAddress.country_code']"
              />

              <CustomInput
                v-if="!shippingCountry || !shippingCountry.states"
                v-model="customer.shippingAddress.state"
                label="State"
                :errors="errors['shippingAddress.state']"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="submit" class="w-full sm:w-auto mt-3 sm:mt-0 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
          Submit
        </button>
        <router-link :to="{ name: 'app.customers' }" class="w-full sm:w-auto mt-3 sm:mt-0 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
          Cancel
        </router-link>
      </footer>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import store from '../../store'
import CustomInput from '../../components/core/CustomInput.vue'

const route = useRoute()
const router = useRouter()

const title = ref('')
const loading = ref(false)

const customer = ref({
  id: null,
  first_name: '',
  last_name: '',
  email: '',
  phone: '',
  status: 'active',
  billingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '',
    state: ''
  },
  shippingAddress: {
    address1: '',
    address2: '',
    city: '',
    zipcode: '',
    country_code: '',
    state: ''
  }
})

const errors = ref({})
const countries = computed(() =>
  store.state.countries.map(c => ({ key: c.code, text: c.name }))
)

const billingCountry = computed(() =>
  store.state.countries.find(c => c.code === customer.value.billingAddress.country_code)
)

const shippingCountry = computed(() =>
  store.state.countries.find(c => c.code === customer.value.shippingAddress.country_code)
)

function onSubmit() {
  loading.value = true

  customer.value.status = customer.value.status ? 'active' : 'disabled'

  const action = customer.value.id ? 'updateCustomer' : 'createCustomer'

  store.dispatch(action, customer.value)
    .then(response => {
      loading.value = false
      if ([200, 201].includes(response.status)) {
        store.commit('showToast', `Customer successfully ${action === 'createCustomer' ? 'created' : 'updated'}`)
        store.dispatch('getCustomers')
        router.push({ name: 'app.customers' })
      }
    })
    .catch(err => {
      loading.value = false
      errors.value = err.response?.data?.errors || {}
    })
}

onMounted(() => {
  store.dispatch('getCountries').then(() => {
    store.dispatch('getCustomer', route.params.id).then(({ data }) => {
      title.value = `Update customer: "${data.first_name} ${data.last_name}"`

      customer.value = {
        ...data,
        billingAddress: {
          ...data.billingAddress,
          country_code: data.billingAddress.country_code || '',
          state: data.billingAddress.state || ''
        },
        shippingAddress: {
          ...data.shippingAddress,
          country_code: data.shippingAddress.country_code || '',
          state: data.shippingAddress.state || ''
        }
      }
    })
  })
})
</script>
