<template>
  <v-container>
    <v-layout>
      <v-flex xs12 md6>
        <v-select outline
                  label="Choose an analysis"
                  :items="analysisCollection"
                  item-text="text"
                  item-value="value"
        ></v-select>
      </v-flex>
      <v-flex xs12 md6>
        <!--<v-btn color="info"></v-btn>-->
        <v-btn color="info" @click="add('AnalysisFrom')">
          <v-icon>add</v-icon>
          Add new analysis
        </v-btn>
      </v-flex>
      <v-flex xs12 md6>
        <v-select outline
                  label="Choose an organism"
                  :items="organismCollection"
                  item-text="text"
                  item-value="value"
        ></v-select>
      </v-flex>
      <v-flex xs12 md6>
        <v-btn color="info" @click="add('OrganismFrom')">
          <v-icon>add</v-icon>
          Add new organism
        </v-btn>
      </v-flex>
      
    </v-layout>
    <v-layout>
      <v-flex xs12 md12>
        <v-autocomplete
          v-model="model"
          :items="items"
          :search-input.sync="search"
          :loading="isLoading"
          hide-no-data
          hide-selected
          item-text="Description"
          item-value="API"
          label="Sequence Type"
          prepend-icon="calendar_view_day"
          return-object
          multiple
        ></v-autocomplete>
      </v-flex>
    </v-layout>
    <v-dialog v-model="dialog" width="70%">
  
      <m-analysis-form v-if="showAnalysis" v-on:dialogClose="close" v-on:addSuccess="addAnalysisSuccess"></m-analysis-form>
      <m-organism-form v-if="showOrganism" v-on:dialogClose="close" v-on:addSuccess="addOrganismSuccess"></m-organism-form>
    </v-dialog>
  </v-container>
</template>

<script>
  import axios from 'axios'
  
  export default {
    data: () => ({
      showAnalysis: false,
      showOrganism: false,
      dialog: false,
      styleObject : {
        backgroundColor: 'white',
      },
      md: {
      
      },
      analysisCollection: [],
      organismCollection: [],
      
      // autocomplete
      model: null,
      search: null,
      isLoading: false,
      entries: [],
    }),
    computed: {
      fields () {
        if (!this.model) return []
      
        return Object.keys(this.model).map(key => {
          return {
            key,
            value: this.model[key] || 'n/a'
          }
        })
      },
      items () {
        return this.entries.map(entry => {
          const Description = entry.Description.length > this.descriptionLimit
            ? entry.Description.slice(0, this.descriptionLimit) + '...'
            : entry.Description
        
          return Object.assign({}, entry, { Description })
        })
      }
    },
    watch: {
      search (val) {
        // Items have already been loaded
        if (this.items.length > 0) return
      
        // Items have already been requested
        if (this.isLoading) return
      
        this.isLoading = true
      
        // Lazily load input items
        fetch('https://api.publicapis.org/entries')
          .then(res => res.json())
          .then(res => {
            const { count, entries } = res
            this.count = count
            this.entries = entries
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => (this.isLoading = false))
      }
    },
    methods: {
      add(form) {
        this.dialog = true
        if (form === 'AnalysisFrom') {
          this.showAnalysis = true
          this.showOrganism = false
        } else {
          this.showOrganism = true
          this.showAnalysis = false
        }
      },
      addAnalysisSuccess (analysis) {
        this.analysisCollection.push({
          value: analysis.id,
          text: analysis.id + '-' + analysis.name,
        })
        this.dialog = false
      },
      addOrganismSuccess (organism) {
        this.organismCollection.push({
          value: organism.id,
          text: organism.id + '-' + organism.common_name,
        })
        this.dialog = false
      },
      close () {
        this.dialog = false
      }
    },
    mounted () {
      let that = this;
      axios.get('/api/analysis').then((res) => {
        axios.get('/api/organisms').then((res) => {
          that.organismCollection = res.data.data.map((organism) => {
            return {
              value: organism.id,
              text: organism.id + '-' + organism.common_name
            }
          })
          console.log(that.orgnasimCollection)
        })
        
        that.analysisCollection = res.data.data.map((analysis) => {
            return {
              value: analysis.id,
              text: analysis.id + '-' + analysis.name,
            }
        })
      })
    }
  }
</script>
