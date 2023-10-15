<template>
  <div>
    <h1>Create new Company</h1>
    <CompanyForm
        v-model="company"
        @submit="createCompany"
    />
  </div>
</template>

<script setup lang="ts">
import {Company} from "~/types/company";
import {PropType} from "vue/dist/vue";

let company = ref<Company>({});

const createCompany = () => {
  alert(company.value.name)
}

</script>

<style scoped lang="scss"></style>
