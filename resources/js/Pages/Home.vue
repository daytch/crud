<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Welcome to the Home Page</h1>
        <p class="text-gray-700">This is the landing page of your application.</p>
        <router-link
            to="/dashboard"
            class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
        >
            Go to Dashboard
        </router-link>
    </div>
</template>

<script>
export default {
    name: 'Home',
};
</script>

<style scoped>
/* Add any page-specific styles here */
</style>
