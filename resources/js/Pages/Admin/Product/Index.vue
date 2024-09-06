<template>
    <Head title="Products" />
    <AdminLayout>
        <ProductList :products = "products" ></ProductList>
    </AdminLayout>
</template>

<script setup>
defineProps({
    products:Array
})
import AdminLayout from '../Components/AdminLayout.vue'
import ProductList from './ProductList.vue'
import { Head } from '@inertiajs/vue3';
</script>