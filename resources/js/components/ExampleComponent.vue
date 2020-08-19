<template>
  <div class="container">
    <table>
      <tr>
        <td style="width:30%;">
          <img src="img/small-logo.png" height="60px" width="60px" />
        </td>
        <td style="width:30%;">
          <h1 class="text-center mt-3 mb-3">Svi izvještaji:</h1>
        </td>
        <td style="width:30%;" class="float-right mt-5 mr-1">
          <button @click="printPage()" class="btn btn-primary mb-3">
            <img src="https://img.icons8.com/color/48/000000/print.png" />
          </button>
        </td>
      </tr>
    </table>

    <table class="table table-sm" id="table" disabled>
      <thead>
        <tr>
          <th scope="col">Datum</th>
          <th scope="col">Projekat</th>
          <th scope="col">Opis radova</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="report in reports" v-bind:key="report.id">
          <th scope="row">{{report.created}}</th>
          <td><a :href="`/reports/${report.id}`">{{report.project}}</a></td>
          <td>{{report.description}}</td>
          <td>
            <button @click="editReport(report)" class="btn btn-outline-warning">Izmijeni</button>
          </td>
          <td>
            <button @click="deleteReport(report.id)" class="btn btn-outline-danger">Izbriši</button>
          </td>
        </tr>
      </tbody>
    </table>
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
    };
  },
  mounted() {
    this.fetchReports();
  },
  methods: {
    async fetchReports() {
      const { data } = await axios.get("/api/report");
      this.reports = data.data;
    },
    async deleteReport(reportId) {
      const result = await Swal.fire({
        title: "Da li ste sigurni?",
        text: "Ovaj izvještaj će biti izbrisan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9b1c1c",
        cancelButtonColor: "#d2d6dc",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        reverseButtons: true,
      });
      if (!result.value) return;
      const { data } = await axios.delete(`/api/report/${reportId}`);
      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Projekat uspješno izbrisan!");
      return (this.reports = this.reports.filter(
        (report) => report.id !== reportId
      ));
    },
    editReport(report) {
      Swal.fire("Hello world!");
    },
    printPage() {
      window.print();
    },
  },
};
</script>
