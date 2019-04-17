<template>
  <v-container fluid grid-list-xl>
    
    <v-layout wrap align-center>
      <v-flex xs6 sm6 d-flex>
        <v-select
          ref="vocabulary"
          v-model="vocabularyName"
          :items="md.items"
          label="Select a Vocabulary"
          outline
          @change="selectVocabulary"
        ></v-select>
      </v-flex>
    </v-layout>
    
    <v-layout wrap align-center v-if="showDetail">
      
      <v-flex xs12 sm12>
        <v-text-field
          label="Vocabulary Name"
          :value="vocabularyName"
          outline
        ></v-text-field>
        <p>Please provide a name for this vocabulary. After upload, this name will appear in the drop down list above for use again later.</p>
      </v-flex>
      
      <v-flex xs12 sm12>
        <v-text-field
          label="Remote URL"
          :value="remoteUrl"
          outline
        ></v-text-field>
        <p>Please enter a URL for the online OBO file. The file will be downloaded and parsed. (e.g. http://www.obofoundry.org/ro/ro.obo</p>
      </v-flex>
      
      <v-flex xs12 sm12>
        <v-text-field
          label="Local File"
          outline
          :value="localFile"
        ></v-text-field>
        <p>Please enter the file system path for an OBO definition file. If entering a path relative to the Drupal installation you may use a relative path that excludes the Drupal installation directory (e.g. sites/default/files/xyz.obo). Note that Drupal relative paths have no preceeding slash. Otherwise, please provide the full path on the filesystem. The path must be accessible to the web server on which this Drupal instance is running.</p>
      </v-flex>
      
      <v-flex xs12 sm12>
        <v-btn flat color="primary" outline @click="submit">Submit</v-btn>
        <v-btn flat color="info" outline @click="reset">Reset</v-btn>
      </v-flex>
      
    </v-layout>
    <v-layout wrap align-center v-if="showCommand">
      <v-flex xs12 sm12>
        <p>You need to execute the command below manually on the command line: </p>
        <div class="green accent-1">
          <p>{{ cmd }}</p>
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import axios from 'axios'
  export default {
    data: () => {
      return {
        showDetail: false,
        showCommand: false,
        vocabularyName: '',
        remoteUrl: '',
        localFile: '',
        cmd: '',
      }
    },
    props: {
      md: Object,
    },
    methods: {
      selectVocabulary () {
        this.showCommand = false
        this.showDetail = true
        this.localFile = this.md.origin[this.vocabularyName]
      },
      reset () {
        this.showDetail = false
        this.vocabularyName = ''
      },
      submit () {
        let that = this;
        axios.post('/api/submitOboFile', {
          'vocabularyName': this.vocabularyName,
          'remoteUrl': this.remoteUrl,
          'localUrl': this.localFile,
        }).then((res) => {
          if (res.data.code !== 200) {
            // TODO write a general message alert
            console.warn(res.data.message)
          } else {
            that.cmd = res.data.data.cmd
            that.showCommand = true
            that.reset()
          }
        })
      }
    }
  }
</script>
