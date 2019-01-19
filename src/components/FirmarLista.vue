<template>
    <desktop :links="links">
    </desktop>
</template>

<script>

    export default {
        path: "/Firmar/Lista",
        mixins: [window.taskMixin],
        computed: {
            links() {
                const links = [];
                this.pendientes.forEach(item => {
                    links.push({
                        text: item.attributes.destinatario,
                        description: item.attributes.comentarios + '\n' + item.attributes.instruccion,
                        href: this.$processCompleteRoute({item: item.attributes.id}),
                        icon: require('../assets/logo.svg'),
                    });
                });
                return links;
            }
        },
        data() {
            return {
                pendientes: new window.ApiArray('/api/derivacion?sort=-id&filter[]=whereNull,firma&per_page=200')
            };
        },
    };
</script>
