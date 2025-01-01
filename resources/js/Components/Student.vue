<template>
    <div class="p-6 bg-white shadow-md rounded-md">
      <h1 class="text-2xl font-bold mb-4">Student</h1>
  
      <!-- Search Bar -->
      <div class="mb-4 flex items-center space-x-2">
        <input 
          v-model="searchQuery"
          type="text"
          placeholder="Search students..."
          class="border px-4 py-2 w-full mb-2"
        />
      </div>
  
      <!-- Add New Student Button -->
      <button @click="openModal" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Add New Student</button>
  
      <!-- Student Table -->
      <table class="table-auto w-full border-collapse">
        <thead>
          <tr class="border-b">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Phone</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="student in paginatedStudents" :key="student.id" class="border-b">
            <td class="px-4 py-2">{{ student.name }}</td>
            <td class="px-4 py-2">{{ student.email }}</td>
            <td class="px-4 py-2">{{ student.phone }}</td>
            <td class="px-4 py-2">
              <button @click="editStudent(student)" class="bg-yellow-500 mr-1 text-white px-2 py-1 rounded">Edit</button>
              <button @click="deleteStudent(student.id)" class="bg-red-500 ml-1 text-white px-2 py-1 rounded">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Pagination Controls -->
      <div class="mt-4 flex justify-between items-center">
        <div>
          <button @click="prevPage" :disabled="currentPage === 1" class="bg-gray-500 text-white px-4 py-2 rounded">Previous</button>
          <button @click="nextPage" :disabled="currentPage === totalPages" class="bg-gray-500 text-white px-4 py-2 rounded">Next</button>
        </div>
        <div class="text-sm">
          Page {{ currentPage }} of {{ totalPages }}
        </div>
      </div>
  
      <!-- Student Form Modal -->
      <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-96">
          <h2 class="text-xl font-bold mb-4">{{ selectedStudent ? 'Edit Student' : 'Add New Student' }}</h2>
          <form @submit.prevent="saveStudent">
            <div class="mb-4">
              <label for="name" class="block text-sm font-semibold">Name</label>
              <input v-model="form.name" id="name" type="text" class="w-full px-4 py-2 border rounded" required />
            </div>
            <div class="mb-4">
              <label for="email" class="block text-sm font-semibold">Email</label>
              <input v-model="form.email" id="email" type="email" class="w-full px-4 py-2 border rounded" required />
            </div>
            <div class="mb-4">
              <label for="phone" class="block text-sm font-semibold">Phone</label>
              <input v-model="form.phone" id="phone" type="text" class="w-full px-4 py-2 border rounded" required />
            </div>
            <div class="flex justify-end space-x-2">
              <button type="button" @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
              <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ selectedStudent ? 'Update' : 'Create' }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        students: [],
        isModalOpen: false,
        selectedStudent: null,
        searchQuery: '',
        currentPage: 1,
        studentsPerPage: 5,
        form: {
          name: '',
          email: '',
          phone: '',
        }
      };
    },
    computed: {
      filteredStudents() {
        return this.students.filter(student => {
          const query = this.searchQuery.toLowerCase();
          return (
            student.name.toLowerCase().includes(query) ||
            student.email.toLowerCase().includes(query) ||
            student.phone.toLowerCase().includes(query)
          );
        });
      },
      paginatedStudents() {
        const start = (this.currentPage - 1) * this.studentsPerPage;
        const end = start + this.studentsPerPage;
        return this.filteredStudents.slice(start, end);
      },
      totalPages() {
        return Math.ceil(this.filteredStudents.length / this.studentsPerPage);
      }
    },
    mounted() {
      this.fetchStudents();
    },
    methods: {
      fetchStudents() {
        axios.get('/api/students', {
          params: {
            search: this.searchQuery,
            per_page: this.studentsPerPage,
          }
        })
        .then(response => {
          this.students = response.data.data;
        })
        .catch(error => console.error(error));
      },
      openModal() {
        this.selectedStudent = null;
        this.form = { name: '', email: '', phone: '' }; // Reset form for new student
        this.isModalOpen = true;
      },
      closeModal() {
        this.isModalOpen = false;
      },
      editStudent(student) {
        this.selectedStudent = student;
        this.form = { ...student };  // Set form data to student details
        this.isModalOpen = true;
      },
      saveStudent() {
        if (this.selectedStudent) {
          // Update existing student
          axios.put(`/api/students/${this.selectedStudent.id}`, this.form)
            .then(() => {
              this.fetchStudents();
              this.closeModal();
            })
            .catch(error => console.error(error));
        } else {
          // Create new student
          axios.post('/api/students', this.form)
            .then(() => {
              this.fetchStudents();
              this.closeModal();
            })
            .catch(error => console.error(error));
        }
      },
      deleteStudent(id) {
        axios.delete(`/api/students/${id}`)
          .then(() => {
            this.fetchStudents();
          })
          .catch(error => console.error(error));
      },
      prevPage() {
        if (this.currentPage > 1) {
          this.currentPage--;
        }
      },
      nextPage() {
        if (this.currentPage < this.totalPages) {
          this.currentPage++;
        }
      }
    }
  };
  </script>
  
  <style scoped>
  /* TailwindCSS styles */
  </style>
  