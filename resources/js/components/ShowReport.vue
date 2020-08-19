<template>
    <div>
        <p>{{report.description}} iz komponente</p>
    </div>
</template>

<script>


export default {

    props : ['reportId'],
  data() {
    return {
        report : '',
    };
  },
  mounted() {
      this.fetchReport();
  },
  methods: {
      async fetchReport() {
          const {data} = await axios.get(`/api/report/${reportId}`);
          console.log(data.data)
          this.report = data.data;
      }
  }
}
</script>
