<div class="grid grid-cols-2 gap-3 mb-3">
    <div>
        <x-input-label for="shipping_country_code" value="Select Country" />
        <select name="shipping[country_code]" x-model="shippingAddress.country_code" id="shipping_country_code"
            class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
            <option value="">Select Country</option>
            <template x-for="country of countries" :key="country.code">
                <option :value="country.code" x-text="country.name"></option>
            </template>
        </select>
    </div>

    <div>
        <template x-if="shippingCountryStates">
            <x-input-label for="shipping_state" value="Select State" />
            <select name="shipping[state]" x-model="shippingAddress.state" id="shipping_state"
                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded">
                <option value="">Select State</option>
                <template x-for="[code, state] of Object.entries(shippingCountryStates)" :key="code">
                    <option :value="code" x-text="state"></option>
                </template>
            </select>
        </template>

        <!-- If no states available, show input for state -->
        <template x-if="!shippingCountryStates">
            <x-input-label for="shipping_state_text" value="State" />
            <input type="text" name="shipping[state]" x-model="shippingAddress.state" id="shipping_state_text"
                placeholder="State"
                class="w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded" />
        </template>
    </div>
</div>
