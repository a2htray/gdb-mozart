<template>
  <div>
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
    </v-container>
    <v-dialog v-model="dialog" width="70%">
      
      <m-analysis-form v-if="showAnalysis" v-on:addSuccess="addAnalysisSuccess" v-on:updateSuccess="updateAnalysisSuccess"></m-analysis-form>
      <m-organism-form v-if="showOrganism"></m-organism-form>
      
    </v-dialog>
  </div>
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
    }),
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
      updateAnalysisSuccess (analysis) {
      
      }
    },
    mounted () {
      let that = this;
      axios.get('/api/analysis').then((res) => {
        that.analysisCollection = res.data.data.map((analysis) => {
            return {
              value: analysis.id,
              text: analysis.id + '-' + analysis.name,
            }
        })
      })
      axios.get('/api/organisms').then((res) => {
        that.orgnasimCollection = res.data.data.map((organism) => {
          return {
            value: organism.id,
            text: organism.id + '-' + organism.name
          }
        })
      })
    }
  }
</script>
