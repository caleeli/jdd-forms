
window.addEventListener('load', () => {
    const FirmarItem = require('./FirmarItem');
    const FirmarLista = require('./FirmarLista');
    const FirmarItemCmp = window.Vue.component('FirmarItem', FirmarItem);
    const FirmarListaCmp = window.Vue.component('FirmarLista', FirmarLista);
    console.log({path: FirmarLista.path ? FirmarLista.path : '/FirmarLista', component: FirmarListaCmp});
    window.router.addRoutes([
        {path: FirmarItem.path ? FirmarItem.path : '/FirmarItem', component: FirmarItemCmp},
        {path: FirmarLista.path ? FirmarLista.path : '/FirmarLista', component: FirmarListaCmp}
    ]);
});

export const icon = require('../assets/logo.svg');
