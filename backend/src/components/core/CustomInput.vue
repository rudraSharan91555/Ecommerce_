<template>
  <div>
    <label class="sr-only">{{ label }}</label>
    <div class="mt-1 flex rounded-md" :class="type === 'checkbox' ? 'items-center' : 'shadow-sm'">
      <span v-if="prepend"
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        {{ prepend }}
      </span>

      <template v-if="type === 'select'">
        <select :name="name"
                :required="required"
                v-model="localValue"
                :class="inputClasses">
          <option value="">-- Select --</option>
          <option v-for="option of selectOptions" :key="option.key" :value="option.key">{{ option.text }}</option>
        </select>
      </template>

      <template v-else-if="type === 'textarea'">
        <textarea :name="name"
                  :required="required"
                  v-model="localValue"
                  :class="inputClasses"
                  :placeholder="label"></textarea>
      </template>

      <template v-else-if="type === 'richtext'">
        <ckeditor :editor="editor"
                  :required="required"
                  :model-value="localValue"
                  @input="updateValue"
                  :class="inputClasses"
                  :config="editorConfig"></ckeditor>
      </template>

      <template v-else-if="type === 'file'">
        <input :type="type"
               :name="name"
               :required="required"
               @change="onFileChange"
               :class="inputClasses"
               :placeholder="label"/>
      </template>

      <template v-else-if="type === 'checkbox'">
        <input :id="id"
               :name="name"
               :type="type"
               :checked="localValue"
               :required="required"
               @change="(e) => updateValue(e.target.checked)"
               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"/>
        <label :for="id" class="ml-2 block text-sm text-gray-900"> {{ label }} </label>
      </template>
      <template v-else>
        <input :type="type"
               :name="name"
               :required="required"
               v-model="localValue"
               :class="inputClasses"
               :placeholder="label"
               step="0.01"/>
      </template>

      <span v-if="append"
            class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
        {{ append }}
      </span>
    </div>

    <small v-if="errors && errors[0]" class="text-red-600">{{ errors[0] }}</small>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const editor = ClassicEditor;

const props = defineProps({
  modelValue: [String, Number, File, Boolean],
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  name: String,
  required: Boolean,
  prepend: {
    type: String,
    default: ''
  },
  append: {
    type: String,
    default: ''
  },
  selectOptions: {
    type: Array,
    default: () => []
  },
  errors: {
    type: Array,
    required: false
  },
  editorConfig: {
    type: Object,
    default: () => ({})
  }
});

const emit = defineEmits(['update:modelValue', 'change']);

const localValue = ref(props.modelValue);

watch(() => props.modelValue, (newVal) => {
  localValue.value = newVal;
});

watch(localValue, (val) => {
  emit('update:modelValue', val);
  emit('change', val);
});

const updateValue = (val) => {
  localValue.value = val;
};

const onFileChange = (e) => {
  const file = e.target.files[0];
  emit('update:modelValue', file);
  emit('change', file);
};

const id = computed(() => {
  return `id-${Math.floor(1000000 + Math.random() * 1000000)}`;
});

const inputClasses = computed(() => {
  const cls = [
    `block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm`,
  ];

  if (props.append && !props.prepend) {
    cls.push(`rounded-l-md`);
  } else if (props.prepend && !props.append) {
    cls.push(`rounded-r-md`);
  } else if (!props.prepend && !props.append) {
    cls.push('rounded-md');
  }
  if (props.errors && props.errors[0]) {
    cls.push('border-red-600 focus:border-red-600');
  }
  return cls.join(' ');
});
</script>

<style scoped>
.ck-editor {
  width: 100%;
}
.ck-content {
  min-height: 200px;
}
</style> 