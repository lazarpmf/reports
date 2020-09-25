<template>
    <div class="container mt-3">
        <create-status ref="CreateStatus"></create-status>
        <div class="card mt-3" v-for="status in statusObject.data" v-bind:key="status.id">
            <div class="card-header d-flex">
                <div class="p-2">{{status.authorName}}</div>
                <div class="ml-auto p-2">{{status.created}}</div>
            </div>
  <div v-html="status.description" class="card-body"></div>

        <div class="ml-auto"><button @click="deleteStatus(status.id)" class="btn btn-link">Izbriši</button></div>

        </div>
            <pagination class="mt-3" :data="statusObject" @pagination-change-page="getResults"></pagination>

    </div>
</template>

<script>
import Swal from "sweetalert2";
import VueToastr from "vue-toastr";


export default {
    name : "AllStatuses",
    
  data () {
      return {
          statuses : [],
          statusObject : {},
      }
  },
    mounted() {
        this.fetchStatuses();
    },
    methods : {
        async fetchStatuses() {
            const {data} = await axios.get('/api/status');
            this.statuses = data.data;
            this.statusObject = data;
        },
        async deleteStatus(statusId) {
            

            const result = await Swal.fire({
        title: "Da li ste sigurni?",
        text: "Ovaj sttaus će biti izbrisan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9b1c1c",
        cancelButtonColor: "#d2d6dc",
        confirmButtonText: "Obriši",
        cancelButtonText: "Odustani",
        reverseButtons: true,
      });
      if (!result.value) return;
      const {data} = await axios.delete(`/api/status/${statusId}`);
      this.$toastr.defaultPosition = "toast-bottom-right";
      this.$toastr.s("Status uspješno izbrisan!");
      return (this.statusObject.data = this.statusObject.data.filter(
        (status) => status.id !== statusId
      ));
        },
        getResults(page = 1) {
            axios.get('api/status?page=' + page)
                .then(response => {
                    this.statusObject = response.data;
                });
        },
    }
}
</script>