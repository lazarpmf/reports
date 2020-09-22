<template>
  <div class="mb-4 mt-4">
    <h1 click="toggleVisibility()">Kreiraj novog radnika:</h1>
    <div id="mainDiv" class="form-group">
      <label for="name">Ime radnika</label>
      <input
        v-model="form.name"
        :class="{'is-invalid' : errors.get('name')}"
        @input="errors.clear('name')"
        type="text"
        class="form-control"
        id="name"
        placeholder="Unesite ime"
      />
      <span class="text-danger" v-if="errors.get('name')">Obavezno polje.</span>
    </div>
    <div class="form-group">
      <label for="email">Email adresa</label>
      <input
        v-model="form.email"
        :class="{'is-invalid' : errors.get('email')}"
        @input="errors.clear('email')"
        type="email"
        class="form-control"
        id="email"
        placeholder="Unesite email"
      />
      <span class="text-danger" v-if="errors.get('email')">Obavezno polje. Email mora biti u formatu korisnik@domen.com</span>
    </div>
    <div class="form-group">
      <label for="password">Lozinka</label>
      <input
        v-model="form.password"
        :class="{'is-invalid' : errors.get('password')}"
        @input="errors.clear('password')"
        type="password"
        class="form-control"
        id="password"
        placeholder="Lozinka"
      />
      <span class="text-danger" v-if="errors.get('password')">Obavezno polje. Lozinka mora sadržati minimum 8 karaktera.
      </span>
    </div>
    <button @click="createWorker()" type="submit" class="btn btn-primary">Dodaj radnika</button>
    <h1 class="mt-3">Svi radnici:</h1>
    <div v-if="workersWithoutAdmin.length == 0">
        <p>Nema radnika.</p>
    </div>
    <div v-for="worker in workersWithoutAdmin" v-bind:key="worker.id">
      <table class="card">
        <tr class="d-flex">
          <td class="w-50 justify-content-start">
                  <b class="ml-5">{{worker.name}}</b>
              </td>
          <td class="w-50 justify-content-end d-flex">
            <button @click="deleteWorker(worker.id)" class="btn btn-danger ml-auto">Ukloni radnika</button>
          </td>
        </tr>
      </table>
    </div>

    <h1>Kreiraj novi projekat</h1>
    <div class="form-group">
    <label for="project">Naziv projekta</label>
    <input @input="errors.clear('project')" :class="{'is-invalid' : errors.get('project')}" v-model="formTwo.project" type="text" class="form-control" id="project" placeholder="Unesite naziv projekta">
    <small class="text-danger" v-if="errors.get('project')">Obavezno polje. Naziv projekta mora biti jedinstven. </small>
  </div>
  <button @click="createProject()" class="btn btn-primary">Dodaj projekat</button>

  <h1 class="mt-3">Svi projekti</h1>
  <div>

  </div>

    <div v-for="project in projects" v-bind:key="project.id">
        <table class="card">
        <tr class="d-flex">
          <td class="w-50 justify-content-start">
                  <b class="ml-5">{{project.project}}</b>
              </td>
          <td class="w-50 justify-content-end d-flex">
            <button @click="deleteProject(project.id)" class="btn btn-danger ml-auto">Ukloni projekat</button>
          </td>
        </tr>
      </table>
    </div>

  </div>
</template>

<script>
import Swal from "sweetalert2";
import Errors from "../helpers/Errors";

export default {
  name: "CreateWorker",
  data() {
    return {
    errors : new Errors(),
    loading : true,
      workers: [],
      form: {
        name: "",
        email: "",
        password: "",
      },
      projects : [],
      formTwo : {
          project : '',
      },
    };
  },
  computed : {
      workersWithoutAdmin () {
          return this.workers.filter(worker => worker.id != 1);
      }
  },
  mounted() {
    this.fetchWorkers();
    this.fetchProjects();
  },
  methods: {
    toggleVisibility() {
      // let element = document.querySelector('#mainDiv');
      // if(element.classList.contains('invisible')){
      //     element.classList.remove('invisible');
      //     element.classList.add('visible');
      // }else{
      //     element.classList.add('visible');
      //     element.classList.remove('invisible');
      // }
    },
    async fetchProjects() {
        const {data} = await axios.get('/api/project');
        this.projects = data.data;
    },
    async deleteProject(projectId) {
        const result = await Swal.fire({
        title: "Da li ste sigurni?",
        text: "Ovaj projekat će biti uklonjen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9b1c1c",
        cancelButtonColor: "#d2d6dc",
        confirmButtonText: "Obriši",
        cancelButtonText: "Odustani",
        reverseButtons: true,
      });
      if (!result.value) return;
      const {data} = await axios.delete(`/api/project/${projectId}`);

      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Projekat uklonjen!");
return this.projects = this.projects.filter(project => project.id != projectId);    },
    async createProject () {
        try{
        const {data} = await axios.post('/api/project', this.formTwo);
        this.projects.unshift(data.data);
        this.$toastr.defaultPosition = "toast-bottom-right";
        this.$toastr.s("Novi projekat kreiran!");
        this.formTwo.project = '';
        }catch(error){
            console.log(error.response.data.errors);
            this.errors.record(error.response.data.errors);
        }
    },
    async deleteWorker(workerId) {
      const result = await Swal.fire({
        title: "Da li ste sigurni?",
        text: "Ovaj radnik će biti uklonjen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9b1c1c",
        cancelButtonColor: "#d2d6dc",
        confirmButtonText: "Obriši",
        cancelButtonText: "Odustani",
        reverseButtons: true,
      });
      if (!result.value) return;
      const { data } = await axios.delete(`/api/user/${workerId}`);

      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Radnik uklonjen!");
      return this.workers = this.workers.filter(worker => worker.id != workerId);
    },
    async createWorker() {
        try{
      const { data } = await axios.post("/api/user", this.form);
      this.workers.push(data.data);
      this.loading = false;
      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Novi radnik kreiran!");
      this.form.name = "";
      this.form.email = "";
      this.form.password = "";
        }catch(error){
            console.log(error.response.data.errors);
            this.errors.record(error.response.data.errors);
        }
    },
    async fetchWorkers() {
      const { data } = await axios.get("/api/user");
      this.workers = data.data;
    },
  },
};
</script>