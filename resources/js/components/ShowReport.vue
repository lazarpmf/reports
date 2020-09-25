<template>
        <div class="container">
    <table style="width:100%" class="d-flex mt-3 mb-2">
        <tr class="w-100 d-flex flex-row justify-content-between">
            <td><a class="btn btn-primary" href="/reports">Nazad</a></td>
            <td><h4>Izvještaj broj {{report.id}}</h4></td>
            <td><img alt="logo" src="/img/small-logo.png" height="60px" width="60px" /></td>
        </tr>
</table>
        <hr>
        <p>Tekst izvještaja:</p>
        <h4>{{report.description}}</h4>
        
              
        <hr>
        <small>Projekat: <b>{{report.project}}</b></small>
        <div><small>Objavljeno: <b>{{report.created}}</b></small></div>
        <small>Objavio: <b>{{report.author}}</b></small>
        <div><small class="mb-3 mt-3">Radili:</small></div>
        <div v-for="worker in report.workers" v-bind:key="worker.id">
            <small><b>{{worker.name}}</b></small>
        </div>  


    </div>
</template>

<script>
export default {
    name : "ShowReport",
    props : ['reportId'],
  data () {
      return {
          report : [],
      }
  },
    mounted () {
        this.fetchReport();
    },
    methods : {
        async fetchReport () {
            const {data} = await axios.get(`/api/report/${this.reportId}`);
            this.report = data.data;
            console.log(this.report)
        }
    },
};
</script>