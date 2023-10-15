<template>
  <form @submit.prevent="emit('submit')">
    <div>
      <label for="email">Name</label>
      <input
          type="text"
          v-model="company.name"
      />
    </div>
    <div>
      <label for="profilePicture">Identity file</label>
      <input
          type="file"
          accept="image/*,.pdf"
          @input="onSelectFile"
      />
    </div>
    <button type="submit">Submit</button>
  </form>
</template>

<script setup lang="ts">

import {PropType} from "vue";
import {Company} from "~/types/company";

const props = defineProps({
  modelValue:{
    type: Object as PropType<Company>,
    default: () => ({id: null, name: 'BB'}),
  }
})

const emit = defineEmits<{
  (e: 'update:modelValue', company: Company): void
  (e: 'submit'): void
}>();

const company = computed<Company>({
  get: () => {
    return props.modelValue
  },
  set: (value) => {
    emit('update:modelValue', value)
  },
});

const onSelectFile = ($event) => {
  const target = $event.target as HTMLInputElement;
  if (target && target.files) {
    company.value.identityFile = target.files[0];
  }
}

</script>

<style scoped lang="scss">

</style>