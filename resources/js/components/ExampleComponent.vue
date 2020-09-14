<template>
<div class="container mt-5">
  <div class="header">
    <a href="/"><div class="image-holder"><img src="img/small-logo.png" alt="logo"></div></a>
    <div><h1>Izvještaji</h1></div>
    <div @click="printPage" id="printImage" class="image-holder print-remove">
      <img src="img/print.png" alt="printer">
    </div>
  </div>
  <create-report ref="CreateReport"></create-report>
  <div class="table">
    <div class="table__row header">
      <div><p>Datum</p></div>
      <div><p>Projekat</p></div>
      <div><p>Opis radova</p></div>
      <div class="create-projcet-button">
        <input class="mr-1 mb-1 mt-1 ml-1 printBtn" type="text" v-model="search" placeholder="Pretraga..."/>
        <button 
        @click="resetForm()"
        type="button" 
        class="btn btn-primary printBtn" 
        data-toggle="modal" 
        data-target="#exampleModal"
        >
        Napravi izvještaj
        </button>
      </div>
    </div>

<div v-if="loading && !reports.length">
    <h1 style="margin-left:23%" class="mt-5">Učitavanje...</h1>
</div>
<div v-else-if="!loading && !reports.length">
    <h1 class="text-center mt-5">Nema izvještaja!</h1>
    <div style="margin-left:37%;" class="mt-3"><button type="button" class="btn btn-primary printBtn" data-toggle="modal" data-target="#exampleModal">Napravi izvještaj</button></div>
</div>

    <div v-else v-for="report in filteredList" v-bind:key="report.id" class="table__row">
      <div data-title="Datum"><p>{{ report.created }}</p><p>{{ report.author }}</p></div>
      <div data-title="Projekat"><p>{{ report.project }}</p></div>
      <div class="job-description" data-title="Opis radova">
        <p>
         {{ report.description }}
        </p>
      </div>
      <div class="table__buttons">
        <button class="button-icon print-remove"><a :href="`/reports/${report.id}`"><img src="img/view.svg" alt="view"></a></button>
        <button v-if="report.isAuthor" @click="editReport(report)" class="button-icon print-remove"><img src="img/edit.svg" alt="edit"></button>
        <button v-if="report.isAuthor" @click="deleteReport(report.id)" class="button-icon print-remove"><img src="img/delete.svg" alt="delete"></button>
      </div>
    </div>
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
      search : '',
      reports: [],
      loading : true,
    };
  },
  computed: {
    filteredList() {
      return this.reports.filter(report => {
        return report.project.toLowerCase().includes(this.search.toLowerCase()) || 
                report.description.toLowerCase().includes(this.search.toLowerCase()) ||
                report.created.toLowerCase().includes(this.search.toLowerCase()) || 
                report.author.toLowerCase().includes(this.search.toLowerCase()) //za authora moram da prikazujem ime autora da bi se znalo da je za to pretraga
                
      })
    },
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
      let buttons = document.querySelectorAll('.print-remove');
      for(let i=0; i<buttons.length; i++){
        buttons[i].style.display = 'none';
      }
      
      window.print();
    },
    resetForm() {
      this.reports.project = '';
      console.log('reseted')
    },
  },
};

</script>

<style scoped>

  #printImage {
    cursor: pointer;
  }
  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .header .image-holder {
    width:60px;
    height: 60px;
  }

  .header .image-holder img { max-width: 100%; }

  .button-icon {
    border:0;
    background: transparent;
    width: 45px;
    height: 45px;
  }

  .table { margin-top: 32px; }

  .table__row {
    border-bottom: 1px solid #dcdcdc; 
    padding: 10px;
    color: #646464;
  }

  .job-description {
    grid-row: 2;
    grid-column: span 2;
  }

  .table__buttons { grid-row: span 2; }

  .create-projcet-button { margin-left: auto; }

  .table__row:not(.header):hover { background-color: rgb(236, 228, 228); }

  .table__row:not(.header) { 
    margin-bottom: 10px;
    display: grid;
    grid-gap: 10px;
    grid-template-columns: 1fr 1fr 32px; 
  }

  .table__row.header { font-weight: bold; }

  .table__row.header > *:not(.create-projcet-button){ display: none; }

  .table__row > div[data-title]::before {
    content: attr(data-title);
    display: block;
    font-weight: bold;
  }

  @media screen and (min-width: 768px) {
  .table__row {
      column-gap: 20px !important;
      grid-template-columns: 100px 100px 1fr auto !important;
    }

    .job-description {
      grid-row: auto;
      grid-column: auto
    }

    .table__buttons { grid-row: auto; }

    .table__row.header { display: grid;}

    .table__row.header > div { display: block !important; }

    .create-projcet-button { margin-left: 0;}

    .table__row > div[data-title]::before { display: none; }
  }

</style>