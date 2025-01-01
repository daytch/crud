import { createRouter, createWebHistory } from 'vue-router';
import MainLayout from './Layouts/MainLayout.vue';
import Home from './Pages/Home.vue';
import Dashboard from './Pages/Dashboard.vue';
import Student from './Components/Student.vue';

const routes = [
    {
        path: '/',
        component: MainLayout, // Use MainLayout as the wrapper
        children: [
            {
                path: '',
                name: 'Home',
                component: Home, // This will be rendered inside MainLayout
            },
            {
                path: 'dashboard',
                name: 'Dashboard',
                component: Dashboard, // This will also use MainLayout
            },
            {
                path: 'student',
                name: 'Student',
                component: Student, // This will also use MainLayout
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
