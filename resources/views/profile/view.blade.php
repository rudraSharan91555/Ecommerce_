<x-app-layout>
    <div x-data="{
            flashMessage: '{{\Illuminate\Support\Facades\Session::get('flash_message')}}',
            init() {
                if (this.flashMessage) {
                    setTimeout(() => this.$dispatch('notify', {message: this.flashMessage}), 200)
                }
            }
        }" class="container mx-auto lg:w-2/3 p-5">
        @if (session('error'))
            <div class="py-2 px-3 bg-red-500 text-white mb-2 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-3 shadow rounded-lg md:col-span-2">
                <form x-data="{
                    countries: {{ json_encode($countries) }},
                    billingAddress: {{ json_encode([
                        'address1' => old('billing.address1', $billingAddress->address1),
                        'address2' => old('billing.address2', $billingAddress->address2),
                        'city' => old('billing.city', $billingAddress->city),
                        'state' => old('billing.state', $billingAddress->state),
                        'country_code' => old('billing.country_code', $billingAddress->country_code),
                        'zipcode' => old('billing.zipcode', $billingAddress->zipcode),
                    ]) }},
                    shippingAddress: {{ json_encode([
                        'address1' => old('shipping.address1', $shippingAddress->address1),
                        'address2' => old('shipping.address2', $shippingAddress->address2),
                        'city' => old('shipping.city', $shippingAddress->city),
                        'state' => old('shipping.state', $shippingAddress->state),
                        'country_code' => old('shipping.country_code', $shippingAddress->country_code),
                        'zipcode' => old('shipping.zipcode', $shippingAddress->zipcode),
                    ]) }},
                    get billingCountryStates() {
                        const country = this.countries.find(c => c.code === this.billingAddress.country_code)
                        if (country && country.states) {
                            return JSON.parse(country.states);
                        }
                        return null;
                    },
                    get shippingCountryStates() {
                        const country = this.countries.find(c => c.code === this.shippingAddress.country_code)
                        if (country && country.states) {
                            return JSON.parse(country.states);
                        }
                        return null;
                    }
                }" action="{{route('profile.update')}}" method="post">
                    @csrf
                    <h2 class="text-xl font-semibold mb-2">Profile Details</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input-label for="first_name" value="First Name" />
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                value="{{ old('first_name', $customer->first_name) }}"
                                placeholder="First Name"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input-label for="last_name" value="Last Name" />
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                value="{{ old('last_name', $customer->last_name) }}"
                                placeholder="Last Name"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <x-input-label for="email" value="Your Email" />
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            placeholder="Your Email"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    
                    <div class="mb-3">
                        <x-input-label for="phone" value="Phone" />
                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $customer->phone) }}"
                            placeholder="Your Phone"
                            class="w-full border-gray-300 focus:border-purple-600 focus:ring-purple-600 rounded-md shadow-sm"
                        />
                    </div>
                    
                    <h2 class="text-xl mt-6 font-semibold mb-2">Billing Address</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input-label for="billing_address1" value="Address 1" />
                            <input
                                type="text"
                                name="billing[address1]"
                                x-model="billingAddress.address1"
                                placeholder="Address 1"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div>
                            <x-input-label value="Address 2" />
                            <input
                                type="text"
                                name="billing[address2]"
                                x-model="billingAddress.address2"
                                placeholder="Address 2"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />                            
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">                        
                        <div class="mb-3">
                            <x-input-label value="City" />
                            <input
                                type="text"
                                name="billing[city]"
                                x-model="billingAddress.city"
                                placeholder="City"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        <div class="mb-3">
                            <x-input-label value="ZipCode" />
                            <input
                                type="text"
                                name="billing[zipcode]"
                                x-model="billingAddress.zipcode"
                                placeholder="ZipCode"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <div class="mb-3">
                                <x-input-label value="Country Code" />
                                <select
                                    name="billing[country_code]"
                                    x-model="billingAddress.country_code"
                                    class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                                >
                                    <option value="">Select Country</option>
                                    <template x-for="country of countries" :key="country.code">
                                        <option :value="country.code" x-text="country.name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div>
                            <template x-if="billingAddress.country_code && billingCountryStates && Object.keys(billingCountryStates).length">
                                <div>
                                    <x-input-label value="State" />
                                    <select
                                        name="billing[state]"
                                        x-model="billingAddress.state"
                                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                                    >
                                        <option value="">Select State</option>
                                        <template x-for="[code, state] of Object.entries(billingCountryStates)" :key="code">
                                            <option :value="code" x-text="state"></option>
                                        </template>
                                    </select>
                                </div>
                            </template>
                    
                            <template x-if="!billingAddress.country_code || !billingCountryStates || !Object.keys(billingCountryStates).length">
                                <div>
                                    <x-input-label value="State" />
                                    <input
                                        type="text"
                                        name="billing[state]"
                                        x-model="billingAddress.state"
                                        placeholder="State"
                                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                                    />
                                </div>
                            </template>
                        </div>
                    </div>
                    


                    <div class="flex justify-between mt-6 mb-2">
                        <h2 class="text-xl font-semibold">Shipping Address</h2>
                        <label for="sameAsBillingAddress" class="text-gray-700">
                            <input @change="$event.target.checked ? shippingAddress = {...billingAddress} : ''"
                                   id="sameAsBillingAddress" type="checkbox"
                                   class="text-purple-600 focus:ring-purple-600 mr-2"> Same as Billing
                        </label>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input-label for="shipping_address1" value="Address 1" />
                            <input
                                type="text"
                                id="shipping_address1"
                                name="shipping[address1]"
                                x-model="shippingAddress.address1"
                                placeholder="Address 1"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    
                        <div>
                            <x-input-label for="shipping_address2" value="Address 2" />
                            <input
                                type="text"
                                id="shipping_address2"
                                name="shipping[address2]"
                                x-model="shippingAddress.address2"
                                placeholder="Address 2"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <x-input-label for="shipping_city" value="City" />
                            <input
                                type="text"
                                id="shipping_city"
                                name="shipping[city]"
                                x-model="shippingAddress.city"
                                placeholder="City"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                        
                        <div>
                            <x-input-label for="shipping_zipcode" value="ZipCode" />
                            <input
                                type="text"
                                id="shipping_zipcode"
                                name="shipping[zipcode]"
                                x-model="shippingAddress.zipcode"
                                placeholder="ZipCode"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <!-- Country Select -->
                        <div>
                            <x-input-label for="shipping_country_code" value="Select Country" />
                            <select
                                name="shipping[country_code]"
                                x-model="shippingAddress.country_code"
                                id="shipping_country_code"
                                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                            >
                                <option value="">Select Country</option>
                                <template x-for="country of countries" :key="country.code">
                                    <option :value="country.code" x-text="country.name"></option>
                                </template>
                            </select>
                        </div>
                    
                        <!-- State Select or Text -->
                        <div>
                            <!-- State Dropdown if states available -->
                            <template x-if="shippingCountryStates && Object.keys(shippingCountryStates).length">
                                <div>
                                    <x-input-label for="shipping_state" value="Select State" />
                                    <select
                                        name="shipping[state]"
                                        x-model="shippingAddress.state"
                                        id="shipping_state"
                                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                                    >
                                        <option value="">Select State</option>
                                        <template x-for="[code, state] of Object.entries(shippingCountryStates)" :key="code">
                                            <option :value="code" x-text="state"></option>
                                        </template>
                                    </select>
                                </div>
                            </template>
                    
                            <!-- Plain input if no state list -->
                            <template x-if="!shippingCountryStates || !Object.keys(shippingCountryStates).length">
                                <div>
                                    <x-input-label for="shipping_state_text" value="State" />
                                    <input
                                        type="text"
                                        name="shipping[state]"
                                        x-model="shippingAddress.state"
                                        id="shipping_state_text"
                                        placeholder="State"
                                        class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                                    />
                                </div>
                            </template>
                        </div>
                    </div>
                    

                    <x-primary-button class="w-full text-center">Update</x-primary-button>

                </form>
            </div>
            <div class="bg-white p-3 shadow rounded-lg">
                <form action="{{route('profile.update')}}" method="post">
                    @csrf
                    <h2 class="text-xl font-semibold mb-2">Update Password</h2>
                    <div class="mb-3">
                        <x-input-label for="old_password" :value="'Your Current Password'" />
                        <x-text-input 
                            id="old_password"
                            type="password"
                            name="old_password"
                            placeholder="Your Current Password"
                            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded mt-1"
                        />
                    </div>
                    
                    <div class="mb-3">
                        <x-input-label for="new_password" :value="'New Password'" />
                        <x-text-input 
                            id="new_password"
                            type="password"
                            name="new_password"
                            placeholder="New Password"
                            class="w-full mt-1 focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    
                    <div class="mb-3">
                        <x-input-label for="new_password_confirmation" :value="'Repeat New Password'" />
                        <x-text-input 
                            id="new_password_confirmation"
                            type="password"
                            name="new_password_confirmation"
                            placeholder="Repeat New Password"
                            class="w-full mt-1 focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded"
                        />
                    </div>
                    
                    <x-primary-button>Update</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
