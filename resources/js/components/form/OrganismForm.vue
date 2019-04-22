<template>
  <v-container :style="styleObject">
    <v-form>
      <h4>Add new organism</h4>
      <v-layout>
        <v-flex md6 class="text-xs-center text-sm-center text-md-center text-lg-center">
          <div :style="styleObjectImage"  @click='pickFile'>
          </div>
          Click to upload image
          <input
            type="file"
            style="display: none"
            ref="image"
            accept="image/*"
            @change="onFilePicked"
          >
        </v-flex>
      </v-layout>
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
        <v-flex><v-btn color="blue darken-1" flat @click="close">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="save">Save</v-btn></v-flex>
      </v-layout>
    </v-form>
  </v-container>
</template>

<script>
  import Quill from 'quill'
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  import axios from 'axios'

  const MODE_ADD = 'add'
  const MODE_UPDATE = 'update'
  
  export default {
    data: () => ({
      editor: null,
      styleObject : {
        backgroundColor: 'white',
      },
      styleObjectImage: {
        backgroundImage: '',
        backgroundSize: 'contain',
        border: '1px solid black',
        height: '150px',
        width: '150px',
      },
      md: {
        imageFile: null,
        genus: '',
        specie: '',
        infraspecificName: '',
        abbreviation: '',
        commonName: '',
        description: '',
      },
      imageUrl: '',
    }),
    methods: {
      save () {
        this.md.description = JSON.stringify(this.editor.getContents())
        const instance = axios.create({
          headers:{
            'Content-Type':'multipart/form-data'
          },
        })
        let formData = new FormData();
        
        for (let key in this.md) {
          formData.append(key, this.md[key])
        }
        
        instance.post('/api/organism', formData).then((res) => {
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
        this.$emit('dialogClose');
      },
      pickFile () {
        this.$refs.image.click ()
      },
      onFilePicked (e) {
        const files = e.target.files
        if(files[0] !== undefined) {
          const fr = new FileReader ()
          fr.readAsDataURL(files[0])
          fr.addEventListener('load', () => {
            this.styleObjectImage.backgroundImage = 'url(' + fr.result + ')'
            this.md.imageFile = files[0];
          })
        } else {
          this.styleObjectImage.backgroundImage = '';
        }
      }
    },
    mounted () {
      this.editor = new Quill('#editor', {
        theme: 'snow'
      });
    }
  }
</script>
