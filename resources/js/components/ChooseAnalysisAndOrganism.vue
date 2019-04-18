<template>
  <div>
    <v-container>
      <v-layout>
        <v-flex xs12 md6>
          <v-select outline
                    label="Choose an analysis"
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
    <v-dialog v-model="dialog" max-width="1000px">
      
      <m-analysis-form v-if="showAnalysis"></m-analysis-form>
      <m-organism-form v-if="showOrganism"></m-organism-form>
      
    </v-dialog>
  </div>
</template>

<script>
  export default {
    data: () => ({
      showAnalysis: false,
      showOrganism: false,
      dialog: false,
      styleObject : {
        backgroundColor: 'white',
      }
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
      }
    }
  }
</script>
