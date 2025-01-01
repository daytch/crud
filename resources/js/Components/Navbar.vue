<template>
  <div>
    <!-- Navbar -->
    <header class="bg-blue-600 p-4 fixed top-0 left-0 w-full z-10">
      <div class="flex justify-between items-center">
        <!-- Navbar Title -->
        <div class="text-white text-xl font-bold">MyApp</div>

        <!-- Hamburger Button for Mobile (top-right) -->
        <button @click="toggleDrawer" class="text-white md:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>

        <!-- Desktop Navbar (Visible only on medium screens and up) -->
        <nav class="hidden md:flex space-x-6">
          <router-link to="/" class="text-white hover:text-gray-300">Home</router-link>
          <router-link to="/about" class="text-white hover:text-gray-300">About</router-link>
          <router-link to="/contact" class="text-white hover:text-gray-300">Contact</router-link>
        </nav>
      </div>
    </header>

    <!-- Drawer (Left Menu) -->
    <div v-if="isDrawerOpen" class="fixed inset-0 flex md:hidden z-20">
      <div class="bg-black opacity-50 w-full" @click="toggleDrawer"></div>
      <div class="bg-blue-700 w-64 h-full shadow-lg transition-transform transform" :class="drawerTransformClass">
        <ul class="text-white space-y-4 py-6 pl-6">
          <li><router-link to="/" @click="toggleDrawer">Home</router-link></li>
          <li><router-link to="/about" @click="toggleDrawer">About</router-link></li>
          <li><router-link to="/contact" @click="toggleDrawer">Contact</router-link></li>
        </ul>
      </div>
    </div>

    <!-- Content Area (shifted right when drawer is open) -->
    <div :class="contentClass" class="transition-all duration-300 pt-16 px-6">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isDrawerOpen: false
    };
  },
  computed: {
    drawerTransformClass() {
      return this.isDrawerOpen ? 'translate-x-0' : '-translate-x-full';
    },
    contentClass() {
      return this.isDrawerOpen ? 'ml-64' : 'ml-0';
    }
  },
  methods: {
    toggleDrawer() {
      this.isDrawerOpen = !this.isDrawerOpen;
    }
  }
};
</script>

<style scoped>
/* Optional: additional styling if needed */
</style>
