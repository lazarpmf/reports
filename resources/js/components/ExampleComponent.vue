<template>
  <div class="container">
    <create-report ref="CreateReport"></create-report>
    <table>
      <tr>
        <td style="width:30%;">
          <a href="/home"><img alt="logo" src="img/small-logo.png" height="60px" width="60px" /></a>
        </td>
        <td style="width:30%;">
          <h1 class="text-center mt-3 mb-3">Svi izvještaji:</h1>
        </td>
        <td style="width:30%;" class="printBtn float-right mt-5 mr-1">
          <button @click="printPage()" class="btn btn-primary mb-3">
            <img src="https://img.icons8.com/color/48/000000/print.png" />
          </button>
        </td>
      </tr>
    </table>

<div v-if="loading && !reports.length">
    <h1 style="margin-left:23%" class="mt-5">Učitavanje...</h1>
</div>
<div v-else-if="!loading && !reports.length">
    <h1 class="text-center mt-5">Nema izvještaja!</h1>
    <div style="margin-left:37%;" class="mt-3"><button type="button" class="btn btn-primary printBtn" data-toggle="modal" data-target="#exampleModal">Napravi izvještaj</button></div>
</div>
<div v-else>
    <table class="table table-sm" id="table" disabled>
      <thead>
        <tr>
          <th scope="col">Datum</th>
          <th scope="col">Projekat</th>
          <th scope="col">Opis radova</th>
          <th><button type="button" class="btn btn-primary printBtn" data-toggle="modal" data-target="#exampleModal">Napravi izvještaj</button></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="report in reports" v-bind:key="report.id">
          <th scope="row">{{report.created}}</th>
          <td>{{report.project}}</td>
          <td>{{report.description}}</td>
          <td><a class="printBtn btn btn-outline-primary" :href="`/reports/${report.id}`">Pogledaj</a></td>
          <td v-if="report.isAuthor">
            <button @click="editReport(report)" class="printBtn btn btn-outline-warning">Izmijeni</button>
          </td>
          <td v-if="report.isAuthor">
            <button @click="deleteReport(report.id)" class="printBtn btn btn-outline-danger">Izbriši</button>
          </td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
import VueToastr from "vue-toastr";
import Swal from "sweetalert2";

Vue.use(VueToastr, {
  defaultClassNames: ["animated", "zoomInUp"],
});

export default {
  data() {
    return {
      reports: [],
      loading : true,
    };
  },
  mounted() {
    this.fetchReports();
  },
  methods: {
    async fetchReports() {
      const { data } = await axios.get("/api/report");
      this.reports = data.data;
      this.loading = false;
    },
    async deleteReport(reportId) {
      const result = await Swal.fire({
        title: "Da li ste sigurni?",
        text: "Ovaj izvještaj će biti izbrisan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9b1c1c",
        cancelButtonColor: "#d2d6dc",
        confirmButtonText: "Obriši",
        cancelButtonText: "Odustani",
        reverseButtons: true,
      });
      if (!result.value) return;
      const { data } = await axios.delete(`/api/report/${reportId}`);
      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Izvještaj uspješno izbrisan!");
      return (this.reports = this.reports.filter(
        (report) => report.id !== reportId
      ));
    },
    editReport(report) {
      const createReport = this.$refs.CreateReport;
      createReport.project = report.singleValue;
      createReport.description = report.description;
      createReport.workers = report.value;
      $('#exampleModal').modal().show();
    },
    printPage() {
      let allPrintBtn = document.querySelectorAll('.printBtn');
      console.log(allPrintBtn.length)
      for(let i=0; i < allPrintBtn.length; i++){
          allPrintBtn[i].style.display='none';
      }
      window.print();
    },
  },
};
</script>
