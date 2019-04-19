<template>
  <v-container :style="styleObject">
    <v-form ref="form">
      <h4>Add new analysis</h4>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Analysis Name" required v-model="md.name"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>This should be a brief name that describes the analysis succintly. This name will helps the user find analyses.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Program, Pipeline or Method Name" required v-model="md.program"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>Program name, e.g. blastx, blastp, sim4, genscan. If the analysis was not derived from a software package, provide a very brief description of the pipeline or method.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Program, Pipeline or Method Version" required v-model="md.programVersion"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>Version description, e.g. TBLASTX 2.0MP-WashU [09-Nov-2000]. Enter 'n/a' if no version is available or applicable.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Algorithm" required v-model="md.algorithm"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>Algorithm name, e.g. blast.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Source Name" required v-model="md.sourceName"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>The name of the source data. This could be a file name, data set name or a small description for how the data was collected. For long descriptions use the description field below</p>
        </v-flex>
      </v-layout>
      <!--<v-layout>-->
        <!--<v-flex md6>-->
          <!--<v-text-field label="Source Version" required></v-text-field>-->
        <!--</v-flex>-->
        <!--<v-flex md6>-->
          <!--<p>If the source dataset has a version, include it here</p>-->
        <!--</v-flex>-->
      <!--</v-layout>-->
      <v-layout>
        <v-flex md6>
          <v-text-field label="Source URI" required v-model="md.sourceURL"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>This is a permanent URL or URI for the source of the analysis. Someone could recreate the analysis directly by going to this URI and fetching the source data (e.g. the blast database, or the training model).</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-menu
            ref="menu"
            v-model="menu"
            :close-on-content-click="false"
            :nudge-right="40"
            lazy
            transition="scale-transition"
            offset-y
            full-width
            min-width="290px"
          >
            <template v-slot:activator="{ on }">
              <v-text-field
                v-model="md.executedAt"
                label="Time Executed"
                readonly
                v-on="on"
              ></v-text-field>
            </template>
            <v-date-picker
              ref="picker"
              v-model="md.executedAt"
              :max="new Date().toISOString().substr(0, 10)"
              min="1950-01-01"
              @change="saveDate"
            ></v-date-picker>
          </v-menu>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex>
          <div style="min-height: 200px;" id="editor">Default description</div>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex><v-btn color="blue darken-1" flat @click="close">Close</v-btn>
        <v-btn color="blue darken-1" flat @click="save">Save</v-btn></v-flex>
      </v-layout>
    </v-form>
  </v-container>
</template>

<script>
  import Quill from 'quill'
  import axios from 'axios'
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  
  const MODE_ADD = 'add'
  const MODE_UPDATE = 'update'
  
  export default {
    data: () => ({
      mode: MODE_ADD,
      editor: null,
      menu: false,
      styleObject : {
        backgroundColor: 'white',
      },
      md: {
        name: '',
        program: '',
        programVersion: '',
        sourceName: '',
        algorithm: '',
        sourceURL: '',
        executedAt: null,
      },
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      }
    },
    methods: {
      saveDate (date) {
        this.$refs.menu.save(date)
      },
      save () {
        this.md.description = JSON.stringify(this.editor.getContents())
        let that = this
        axios.post('/api/analysis', this.md).then((res) => {
          if (res.data.code !== 200) {
            that.$root.$emit('alert', 'error', res.data.message)
          } else {
            
            if (that.mode === MODE_ADD) {
              that.$emit('addSuccess', res.data.data)
            } else {
              that.$emit('updateSuccess', res.data.data)
            }
          }
        })
      },
      close () {
      
      },
    },
    mounted () {
      this.editor = new Quill('#editor', {
        theme: 'snow'
      });
    }
  }
</script>
