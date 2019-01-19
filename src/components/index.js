
window.addEventListener('load', () => {
    const FirmarItem = require('./FirmarItem');
    const FirmarLista = require('./FirmarLista');
    window.router.addRoutes([
        {path: FirmarItem.path ? FirmarItem.path : '/FirmarItem', component: FirmarItem},
        {path: FirmarLista.path ? FirmarLista.path : '/FirmarLista', component: FirmarLista}
    ]);
});

export const icon = require('../assets/logo.svg');
