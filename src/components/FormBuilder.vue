<template>
  <panel name="Construir formulario" class="panel-primary">
    <div class="row">
      <div class="col-12">
        <div class="d-inline-block">
          <button
            type="button"
            :disabled="!canUndo"
            @click="save"
            class="btn btn-outline-secondary btn-sm"
          ><i class="fas fa-save"></i></button>
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
        <jdd-form v-model="form" :root="me"/>
      </div>
      <div class="col-4">
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
  path: "/Forms/Editor",
  components: {
    JddForm,
    Inspector,
    Palete
  },
  mixins: [AppUndoRedo],
  computed: {
    me() {
      return this;
    }
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
      form: new ApiObject('/api/form/' + this.$route.params.id, errores),
      selected: this.form,
      selectedElement: null,
      palete: {
        items: paleteItems
      }
    };
  },
  methods: {
    save() {
      if (this.form.id) {
          this.form.putToAPI("/api/form/" + this.form.id).then(() => {
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
      this.form.loadFromAPI('/api/form/' + this.$route.params.id);
    },
    'form' () {
      this.$store.dispatch('loadContent', this.form.attributes.content);
      while(this.canUndo) {
        this.undo();
      }
    },
  },
};
</script>
