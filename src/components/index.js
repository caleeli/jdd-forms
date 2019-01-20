
// Icon for start event "firmas"
require('../assets/firmas.svg');

window.addEventListener('load', () => {
    const FirmarItem = require('./FirmarItem').default;
    const FirmarLista = require('./FirmarLista').default;
    window.router.addRoutes([
        {path: FirmarItem.path, component: FirmarItem},
        {path: FirmarLista.path, component: FirmarLista}
    ]);
});

export const icon = require('../assets/logo.svg');
