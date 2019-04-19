<template>
  <v-container :style="styleObject">
    <v-form>
      <h4>Add new organism</h4>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Genus" v-model="md.genus"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Species" v-model="md.specie"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Infraspecific Name" required v-model="md.infraspecificName"></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>The infraspecific name for this organism. When diplaying the full taxonomic name, this field is appended to the genus, species.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Abbreviation" v-model="md.abbreviation"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Common Name" required v-model="md.commonName"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex>
          <div style="min-height: 200px;" id="editor">Default description</div>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex><v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="save">Save</v-btn></v-flex>
      </v-layout>
    </v-form>
  </v-container>
</template>

<script>
  import Quill from 'quill'
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  export default {
    data: () => ({
      editor: null,
      styleObject : {
        backgroundColor: 'white',
      },
      md: {
        genus: '',
        specie: '',
        infraspecificName: '',
        abbreviation: '',
        commonName: '',
      }
    }),
    methods: {
      save () {
        this.md.description = JSON.stringify(this.editor.getContents())
        console.log(this.md)
      }
    },
    mounted () {
      this.editor = new Quill('#editor', {
        theme: 'snow'
      });
    }
  }
</script>
