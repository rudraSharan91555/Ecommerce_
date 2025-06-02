<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div x-data="{
            flashMessage: '<?php echo e(\Illuminate\Support\Facades\Session::get('flash_message')); ?>',
            init() {
                if (this.flashMessage) {
                    setTimeout(() => this.$dispatch('notify', {message: this.flashMessage}), 200)
                }
            }
        }" class="container mx-auto lg:w-2/3 p-5">
        <?php if(session('error')): ?>
            <div class="py-2 px-3 bg-red-500 text-white mb-2 rounded">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
            <div class="bg-white p-3 shadow rounded-lg md:col-span-2">
                <form x-data="{
                    countries: <?php echo e(json_encode($countries)); ?>,
                    billingAddress: <?php echo e(json_encode([
                        'address1' => old('billing.address1', $billingAddress->address1),
                        'address2' => old('billing.address2', $billingAddress->address2),
                        'city' => old('billing.city', $billingAddress->city),
                        'state' => old('billing.state', $billingAddress->state),
                        'country_code' => old('billing.country_code', $billingAddress->country_code),
                        'zipcode' => old('billing.zipcode', $billingAddress->zipcode),
                    ])); ?>,
                    shippingAddress: <?php echo e(json_encode([
                        'address1' => old('shipping.address1', $shippingAddress->address1),
                        'address2' => old('shipping.address2', $shippingAddress->address2),
                        'city' => old('shipping.city', $shippingAddress->city),
                        'state' => old('shipping.state', $shippingAddress->state),
                        'country_code' => old('shipping.country_code', $shippingAddress->country_code),
                        'zipcode' => old('shipping.zipcode', $shippingAddress->zipcode),
                    ])); ?>,
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
                }" action="<?php echo e(route('profile.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <h2 class="text-xl font-semibold mb-2">Profile Details</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'first_name','value' => ''.e(old('first_name', $customer->first_name)).'','placeholder' => 'First Name','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'first_name','value' => ''.e(old('first_name', $customer->first_name)).'','placeholder' => 'First Name','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'last_name','value' => ''.e(old('last_name', $customer->last_name)).'','placeholder' => 'Last Name','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'last_name','value' => ''.e(old('last_name', $customer->last_name)).'','placeholder' => 'Last Name','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'email','value' => ''.e(old('email', $user->email)).'','placeholder' => 'Your Email','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'email','value' => ''.e(old('email', $user->email)).'','placeholder' => 'Your Email','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'phone','value' => ''.e(old('phone', $customer->phone)).'','placeholder' => 'Your Phone','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'phone','value' => ''.e(old('phone', $customer->phone)).'','placeholder' => 'Your Phone','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>

                    <h2 class="text-xl mt-6 font-semibold mb-2">Billing Address</h2>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'billing[address1]','xModel' => 'billingAddress.address1','placeholder' => 'Address 1','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'billing[address1]','x-model' => 'billingAddress.address1','placeholder' => 'Address 1','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'billing[address2]','xModel' => 'billingAddress.address2','placeholder' => 'Address 2','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'billing[address2]','x-model' => 'billingAddress.address2','placeholder' => 'Address 2','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'billing[city]','xModel' => 'billingAddress.city','placeholder' => 'City','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'billing[city]','x-model' => 'billingAddress.city','placeholder' => 'City','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'billing[zipcode]','xModel' => 'billingAddress.zipcode','placeholder' => 'ZipCode','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'billing[zipcode]','x-model' => 'billingAddress.zipcode','placeholder' => 'ZipCode','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'select','name' => 'billing[country_code]','xModel' => 'billingAddress.country_code','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select','name' => 'billing[country_code]','x-model' => 'billingAddress.country_code','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
                                <option value="">Select Country</option>
                                <template x-for="country of countries" :key="country.code">
                                    <option :selected="country.code === billingAddress.country_code"
                                            :value="country.code" x-text="country.name"></option>
                                </template>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <template x-if="billingCountryStates">
                                <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'select','name' => 'billing[state]','xModel' => 'billingAddress.state','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select','name' => 'billing[state]','x-model' => 'billingAddress.state','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
                                    <option value="">Select State</option>
                                    <template x-for="[code, state] of Object.entries(billingCountryStates)"
                                              :key="code">
                                        <option :selected="code === billingAddress.state"
                                                :value="code" x-text="state"></option>
                                    </template>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                            </template>
                            <template x-if="!billingCountryStates">
                                <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'billing[state]','xModel' => 'billingAddress.state','placeholder' => 'State','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'billing[state]','x-model' => 'billingAddress.state','placeholder' => 'State','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
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
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'shipping[address1]','xModel' => 'shippingAddress.address1','placeholder' => 'Address 1','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'shipping[address1]','x-model' => 'shippingAddress.address1','placeholder' => 'Address 1','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'shipping[address2]','xModel' => 'shippingAddress.address2','placeholder' => 'Address 2','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'shipping[address2]','x-model' => 'shippingAddress.address2','placeholder' => 'Address 2','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'shipping[city]','xModel' => 'shippingAddress.city','placeholder' => 'City','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'shipping[city]','x-model' => 'shippingAddress.city','placeholder' => 'City','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['name' => 'shipping[zipcode]','xModel' => 'shippingAddress.zipcode','type' => 'text','placeholder' => 'ZipCode','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'shipping[zipcode]','x-model' => 'shippingAddress.zipcode','type' => 'text','placeholder' => 'ZipCode','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'select','name' => 'shipping[country_code]','xModel' => 'shippingAddress.country_code','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select','name' => 'shipping[country_code]','x-model' => 'shippingAddress.country_code','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
                                <option value="">Select Country</option>
                                <template x-for="country of countries" :key="country.code">
                                    <option :selected="country.code === shippingAddress.country_code"
                                            :value="country.code" x-text="country.name"></option>
                                </template>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                        </div>
                        <div>
                            <template x-if="shippingCountryStates">
                                <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'select','name' => 'shipping[state]','xModel' => 'shippingAddress.state','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'select','name' => 'shipping[state]','x-model' => 'shippingAddress.state','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
                                    <option value="">Select State</option>
                                    <template x-for="[code, state] of Object.entries(shippingCountryStates)"
                                              :key="code">
                                        <option :selected="code === shippingAddress.state"
                                                :value="code" x-text="state"></option>
                                    </template>
                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                            </template>
                            <template x-if="!shippingCountryStates">
                                <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'text','name' => 'shipping[state]','xModel' => 'shippingAddress.state','placeholder' => 'State','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'shipping[state]','x-model' => 'shippingAddress.state','placeholder' => 'State','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                            </template>
                        </div>
                    </div>

                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full']); ?>Update <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                </form>
            </div>
            <div class="bg-white p-3 shadow rounded-lg">
                <form action="<?php echo e(route('profile_password.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <h2 class="text-xl font-semibold mb-2">Update Password</h2>
                    <div class="mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'password','name' => 'old_password','placeholder' => 'Your Current Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'old_password','placeholder' => 'Your Current Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'password','name' => 'new_password','placeholder' => 'New Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'new_password','placeholder' => 'New Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <?php if (isset($component)) { $__componentOriginal13afeff3c398c925ed332806e702df71 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal13afeff3c398c925ed332806e702df71 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-field','data' => ['type' => 'password','name' => 'new_password_confirmation','placeholder' => 'Repeat New Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'new_password_confirmation','placeholder' => 'Repeat New Password','class' => 'w-full focus:border-purple-600 focus:ring-purple-600 border-gray-300 rounded']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $attributes = $__attributesOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__attributesOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13afeff3c398c925ed332806e702df71)): ?>
<?php $component = $__componentOriginal13afeff3c398c925ed332806e702df71; ?>
<?php unset($__componentOriginal13afeff3c398c925ed332806e702df71); ?>
<?php endif; ?>
                    </div>
                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Update <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                </form>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\rudra\Desktop\Laravel_New\laravel_Ecommerce\resources\views/profile/view.blade.php ENDPATH**/ ?>