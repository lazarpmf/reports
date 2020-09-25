<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{reportId ? 'Izmijeni izvještaj' : 'Kreiraj izvještaj'}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div>
                <label class="typo__label">Projekat</label>
                <multiselect 
                @input="errors.clear('project')"
                v-model="singleValue" 
                :options="singleOptions" 
                :searchable="false" 
                :close-on-select="true" 
                :show-labels="false" 
                placeholder="Izaberite projekat"></multiselect>
            </div>
            <div><small class="text-danger" v-if="errors.get('project')">Morate izabrati projekat.</small></div>

            <label for="description">Opis posla</label>
            <textarea 
            @input="errors.clear('description')" 
            :class="{'is-invalid' : errors.get('description')}"
            v-model="form.description" 
            type="text" 
            class="form-control" 
            id="description" 
            placeholder="Unesite opis posla"
            >
            </textarea>
            <small class="text-danger" v-if="errors.get('description')">Morate unijeti opis posla.</small>
        <div>
  <label class="typo__label">Izaberi radnike</label>
  <multiselect 
  v-model="value" 
  :options="users" 
  :multiple="true" 
  :close-on-select="true" 
  :clear-on-select="false" 
  :preserve-search="true" 
  placeholder="Izaberi radnika" 
  label="name" 
  track-by="name" 
  :preselect-first="true"
  >
    <template slot="selection" slot-scope="{ values, isOpen }">
        <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">
                {{ values.length }} radnika odabrano
        </span>
    </template>
  </multiselect>
</div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
        <button id="saveBtn" @click="postReport()" type="button" class="btn btn-primary">Sačuvaj</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import Multiselect from 'vue-multiselect'
import Errors from "../helpers/Errors";

export default {
    components: {Multiselect},
    data() {
    return {
        reportId : null,
        errors : new Errors(),
        singleValue: '',
        value: [],
        options: [],
        users : [],
        singleOptions : [],
        form : {
            description : '',
            project: [],
            workers: [],
        },
    }
  },
  mounted() {
      this.fetchUsers();
      this.fetchProjects();
  },
  methods : {
    async fetchProjects() {
          const {data} = await axios.get('/api/project');
          this.singleOptions = data.data.map(option => option.project);
      },
      async fetchUsers() {
          const {data} = await axios.get('/api/user');
          this.users = data.data;
      },
      async postReport() {
          try {
             if (this.reportId) {
               const form = Object.assign({}, this.form);
               form._method = 'PUT';
               const {data} = await axios.post(`/api/report/${this.reportId}`, form);
                const reportIndex = this.$parent.reportObject.data.findIndex(report => report.id === this.reportId);
                        this.$set(this.$parent.reportObject.data, reportIndex, data.data);
                        this.reportId = null;
                        jQuery.noConflict();
                        $('#exampleModal').modal('hide');
                        this.$toastr.defaultPosition = "toast-bottom-right";
                        this.$toastr.i
                        (
                            "Izvještaj uspješno izmijenjen!"
                        );
                    }
                    else{
            const form = Object.assign({}, this.form);
            form.project = this.singleValue;
            
            form.workers = this.value.map(index => index.id);
            console.log(form.workers)
            const {data} = await axios.post(`/api/report`, form);
            console.log(form.description)
            this.$parent.reportObject.data.unshift(data.data);
            this.$toastr.defaultPosition = "toast-bottom-right";
            this.$toastr.s("Izvještaj uspješno objavljen!");
            jQuery.noConflict();
            $('#exampleModal').modal('hide');
                    }
          } catch (error) {
                console.log(error.response.data.errors);
                this.errors.record(error.response.data.errors);
          }
      },
  },
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
