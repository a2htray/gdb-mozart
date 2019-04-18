<template>
  <v-container :style="styleObject">
    <v-form>
      <h4>Add new organism</h4>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Genus"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Species "></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Infraspecific Name" required></v-text-field>
        </v-flex>
        <v-flex md6>
          <p>The infraspecific name for this organism. When diplaying the full taxonomic name, this field is appended to the genus, species.</p>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Abbreviation"></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex md6>
          <v-text-field label="Common Name" required></v-text-field>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex>
          <div style="min-height: 200px;" id="editor">Default description</div>
        </v-flex>
      </v-layout>
      <v-layout>
        <v-flex><v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="dialog = false">Save</v-btn></v-flex>
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
      date: null,
      menu: false,
      styleObject : {
        backgroundColor: 'white',
      }
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      }
    },
    methods: {
      save (date) {
        this.$refs.menu.save(date)
      }
    },
    mounted () {
      let editor = new Quill('#editor', {
        theme: 'snow'
      });
      console.log(111)
    }
  }
</script>
