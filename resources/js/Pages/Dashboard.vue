<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="text-gray-700">Welcome to your dashboard! Here you can manage your data and settings.</p>
        <router-link
            to="/"
            class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
        >
            Back to Home
        </router-link>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
};
</script>

<style scoped>
/* Add any page-specific styles here */
</style>
