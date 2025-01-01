<template>
    <div class="flex h-screen">
        <!-- Drawer -->
        <aside
            :class="{
                'translate-x-0': isDrawerOpen,
                '-translate-x-full': !isDrawerOpen,
            }"
            class="fixed z-20 inset-y-0 left-0 w-64 bg-gray-800 text-white transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
        >
            <div class="flex items-center justify-between p-4 border-b border-gray-700">
                <h2 class="text-lg font-bold">Menu</h2>
                <button @click="toggleDrawer" class="md:hidden text-gray-400 hover:text-white">
                    ✕
                </button>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <router-link
                            to="/"
                            class="block px-4 py-2 rounded hover:bg-gray-700"
                        >
                            Home
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/dashboard"
                            class="block px-4 py-2 rounded hover:bg-gray-700"
                        >
                            Dashboard
                        </router-link>
                    </li>
                    <li>
                        <router-link
                            to="/student"
                            class="block px-4 py-2 rounded hover:bg-gray-700"
                        >
                            Student
                        </router-link>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-gray-100 p-4 flex items-center justify-between shadow-md md:hidden">
                <button @click="toggleDrawer" class="text-gray-600 hover:text-black">
                    ☰
                </button>
                <!-- <h1 class="text-lg font-bold">My Application</h1> -->
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 bg-gray-50">
                <router-view />
            </main>

            <!-- Footer -->
            <footer class="bg-gray-100 text-center p-4">
                <p>© 2025 Your Company</p>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    name: 'MainLayout',
    data() {
        return {
            isDrawerOpen: false, // Define isDrawerOpen to fix the warning
        };
    },
    methods: {
        toggleDrawer() {
            this.isDrawerOpen = !this.isDrawerOpen;
        },
    },
};
</script>

<style scoped>
/* Scoped styles for additional customization if needed */
</style>
