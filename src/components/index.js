
// Icon for start event "forms"
require('../assets/forms.svg');

window.addEventListener('load', () => {
    const FormBuilder = require('./FormBuilder').default;
    window.router.addRoutes([
        {path: FormBuilder.path, component: FormBuilder},
    ]);
});

export const icon = require('../assets/logo.svg');
