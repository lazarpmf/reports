<template>
        <div class="container">
    <table style="width:100%" class="mt-3 mb-2">
    <thead style="width:100%">
        <th class="w-100">
            <td style="width:25%;"><a class="btn btn-primary" href="/reports">Nazad</a></td>
            <td style="width:35%;"><h4>Izvještaj broj {{report.id}}</h4></td>
            <td style="width:35%;"><img alt="logo" src="/img/small-logo.png" height="60px" width="60px" /></td>
        </th>
    </thead>
</table>
        <hr>
        <p>Tekst izvještaja:</p>
        <h4>{{report.description}}</h4>
        <!-- <p class="mb-3 mt-3">Radili:</p>
        <div v-for="rep in report.workers" v-bind:key="rep.id">
            <div>{{rep.name.toString()}}</div>
        </div> -->
        <hr>
        <small>Projekat: {{report.project}}</small>
        <div><small>Objavljeno: {{report.created}}</small></div>
        <small>Objavio: {{report.author}}</small>


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