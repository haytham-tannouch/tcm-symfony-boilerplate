<template>
  <div v-if="!companyPending">
    <h1>Edit company {{ company.name }}</h1>
    <CompanyForm
        v-model="company"
        @submit="updateCompany"
    />
  </div>
</template>

<script setup lang="ts">
import useGetCompany from "~/composables/api/company/useGetCompany";
import {Company} from "~/types/company";

const route = useRoute();

const {
  data,
  pending: companyPending,
} = await useGetCompany(route.params.id)
const company = data as Company

const updateCompany = () => {
  alert(company.value.name)
}
</script>

<style scoped lang="scss"></style>
