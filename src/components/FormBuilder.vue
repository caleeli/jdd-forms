<template>
  <panel name="Construir formulario" class="panel-primary">
    <div class="row">
      <div class="col-12">
        <input class="form-control d-inline-block" v-model="title" style="width:16em;">
        <div class="d-inline-block">
          <button
            type="button"
            @click="save"
            class="btn btn-outline-secondary btn-sm"
          ><i class="fas fa-save"></i></button>
          <button
            v-show="mode==='design'"
            type="button"
            @click="preview"
            class="btn btn-outline-secondary btn-sm"
          ><i class="fas fa-play"></i></button>
          <button
            v-show="mode==='preview'"
            type="button"
            @click="design"
            class="btn btn-outline-secondary btn-sm"
          ><i class="fas fa-pencil-ruler"></i></button>
          <button
            type="button"
            :disabled="!canUndo"
            @click="undo"
            class="btn btn-outline-secondary btn-sm"
          >Undo</button>
          <button
            type="button"
            :disabled="!canRedo"
            @click="redo"
            class="btn btn-outline-secondary btn-sm"
          >Redo</button>
        </div>
        <palete class="d-inline-block" v-model="palete"/>
      </div>
      <div class="col-8">
        <jdd-form :class="formClass" v-model="form" :root="me"/>
      </div>
      <div class="col-4" v-show="mode==='design'">
        <inspector v-if="selected" v-model="selected" :element="selectedElement" :root="me"/>
      </div>
    </div>
  </panel>
</template>

<script>
import VueJddForm from "vue-jdd-form";
import AppUndoRedo from "../mixins/AppUndoRedo";
const JddForm = VueJddForm.JddForm;
const Inspector = VueJddForm.Inspector;
const Palete = VueJddForm.Palete;

export default {
  path: "/Forms/Editor/:id",
  components: {
    JddForm,
    Inspector,
    Palete
  },
  mixins: [AppUndoRedo, window.taskMixin],
  computed: {
    me() {
      return this;
    },
    formClass() {
      return this.mode === 'design' ? 'form-design' : 'form-view';
    },
  },
  data() {
    const paleteItems = [];
    // Container
    paleteItems.push({
      tag: "JddContainer",
      label: "Contenedor",
      content: {
        tag: "JddContainer",
        class: "row",
        JddContainer: [],
        JddControl: [],
        $: {}
      }
    });
    // Text
    paleteItems.push({
      tag: "JddControl",
      label: "Texto",
      inspector: {
        template: {
          component: "PropertyHtml",
          props: { apiKey: "ec6a29bmn9f3zt7dxgrs6op4uxcpmoa3cphigv7fijs3g2c6" }
        }
      },
      content: {
        tag: "JddControl",
        component: "VHtml",
        $: { template: "" }
      }
    });
    // TextInput
    paleteItems.push({
      tag: "JddControl",
      label: "Caja texto simple",
      inspector: {},
      content: {
        tag: "JddControl",
        component: "TextInput",
        $: {}
      }
    });
    // TextBox
    paleteItems.push({
      tag: "JddControl",
      label: "Caja texto",
      inspector: {},
      content: {
        tag: "JddControl",
        component: "TextBox",
        $: {}
      }
    });
    // Checkbox
    paleteItems.push({
      tag: "JddControl",
      label: "Check",
      inspector: {},
      content: {
        tag: "JddControl",
        component: "Checkbox",
        $: {}
      }
    });
    // Upload
    paleteItems.push({
      tag: "JddControl",
      label: "Subir Doc.",
      inspector: {},
      content: {
        tag: "JddControl",
        component: "SimpleUpload",
        $: {}
      }
    });
    const errores = {};
    return {
      mode: 'design',
      title: '',
      data: new window.ApiObject('/api/form/' + this.$route.params.id, errores).loadFromAPI(),
      selected: this.form,
      selectedElement: null,
      palete: {
        items: paleteItems
      }
    };
  },
  methods: {
    design() {
      this.mode = 'design';
    },
    preview() {
      this.mode = 'preview';
    },
    save() {
      this.data.attributes.content = JSON.parse(JSON.stringify(this.form));
      this.data.attributes.name = this.title;
      if (this.data.id) {
          this.data.putToAPI("/api/form/" + this.data.id).then(() => {
              this.$router.push(this.$processCompleteRoute({accion:"completar"}));
          });
      } else {
          this.data.postToAPI("/api/form").then(() => {
              this.$router.push(this.$processCompleteRoute({accion:"completar"}));
          });
      }
    },
    select(selected, element) {
      this.selected = selected;
      this.selectedElement = element;
    }
  },
  watch: {
    '$route.params.id' () {
      this.data.loadFromAPI('/api/form/' + this.$route.params.id);
    },
    'data':{
      handler() {
        this.$store.dispatch('loadContent', this.data.attributes.content);
        this.title = this.data.attributes.name;
        if (!this.canUndo) {
          this.$store.commit('emptyState');
        } else {
          while(this.canUndo) {
            this.undo();
          }
        }
      },
      deep:true,
    }
  },
};
</script>
