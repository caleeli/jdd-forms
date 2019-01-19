
window.addEventListener('load', () => {
    const FirmarItem = require('./FirmarItem').default;
    const FirmarLista = require('./FirmarLista').default;
    console.log({path: FirmarLista.path, component: FirmarLista});
    window.router.addRoutes([
        {path: FirmarItem.path, component: FirmarItem},
        {path: FirmarLista.path, component: FirmarLista}
    ]);
});

export const icon = require('../assets/logo.svg');
