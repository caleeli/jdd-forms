<template>
  <panel name="Selecciona un formulario" class="panel-primary">
    <div class="row">
      <div class="col-12">
        <desktop :links="links"></desktop>
      </div>
    </div>
  </panel>
</template>

<script>
export default {
  path: "/Forms/List",
  mixins: [window.taskMixin],
  computed: {
    links() {
      const links = [
          {
            text: 'Nuevo formulario',
            description: 'Crea un nuevo formulario',
            href: this.$processCompleteRoute({ item: 'create' }),
            icon: require("../assets/new-form.svg")
          },
      ];
      this.pendientes.forEach(item => {
        links.push({
          text: item.attributes.name,
          description: '(' + item.id + ')',
          href: this.$processCompleteRoute({ item: item.id }),
          icon: require("../assets/logo.svg")
        });
      });
      return links;
    }
  },
  data() {
    return {
      pendientes: new window.ApiArray(
        "/api/forms?sort=-id&per_page=200"
      )
    };
  }
};
</script>
