<template>
  <v-flex>
          <horizontal-stepper :steps="steps" @completed-step="completeStep"
                              @active-step="isStepActive" @stepper-finished="alert"
          >
          </horizontal-stepper>
  </v-flex>
</template>

<script>
  import HorizontalStepper from 'vue-stepper';
  import ChooseAnalysisAndOrganism from '../ChooseAnalysisAndOrganism.vue';
  import ChooseFastaFile from '../ChooseFastaFile.vue';
  
  export default {
    components: {
      HorizontalStepper
    },
    data(){
      return {
        steps: [
          {
            icon: 'call_made',
            name: 'first',
            title: 'Choose Analysis and Organism',
            subtitle: 'maybe you need to create one',
            component: ChooseAnalysisAndOrganism,
            completed: false
            
          },
          {
            icon: 'insert_drive_file',
            name: 'second',
            title: 'Type the path of fasta file',
            subtitle: 'maybe you need to know the path of file',
            component: ChooseFastaFile,
            completed: false
          }
        ]
      }
    },
    methods: {
      // Executed when @completed-step event is triggered
      completeStep(payload) {
        this.steps.forEach((step) => {
          if (step.name === payload.name) {
            step.completed = true;
          }
        })
      },
      // Executed when @active-step event is triggered
      isStepActive(payload) {
        this.steps.forEach((step) => {
          if (step.name === payload.name) {
            if(step.completed === true) {
              step.completed = false;
            }
          }
        })
      },
      // Executed when @stepper-finished event is triggered
      alert(payload) {
        alert('end')
      }
    }
  }
</script>
