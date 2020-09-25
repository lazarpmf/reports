<template>
    <div class="container">
        <center><h1>Statusi:</h1></center>
    <tinymce @input="errors.clear('description')" id="d1" v-model="form.description"></tinymce>
    <div><small class="text-danger" v-if="errors.get('description')">Obavezno polje.</small></div>
    <button class="btn btn-primary mt-3" @click="postStatus">Postavi</button>
    </div>
</template>

<script>
import Vue from 'vue'
import tinymce from 'vue-tinymce-editor'
Vue.component('tinymce', tinymce)
import Errors from "../helpers/Errors";

export default {
    name : "CreateStatus",
    
  data () {
      return {
          errors : new Errors(),
          form : {
              description : '',
          },
      }
  },
    methods : {
        async postStatus() {
            try{
            const form = Object.assign(this.form);
            const {data} = await axios.post('/api/status', form);
            this.$parent.statusObject.data.unshift(data.data);
            this.$toastr.defaultPosition = "toast-bottom-right";
            this.$toastr.s("Status uspješno objavljen!");
            this.form.description = '';
            }catch(error){
                console.log(error.response.data.errors);
                this.errors.record(error.response.data.errors);
            }
        }
    }
}
</script>