
// Icon for start event "forms"
require('../assets/forms.svg');

window.addEventListener('load', () => {
    const FormList = require('./FormList').default;
    const FormBuilder = require('./FormBuilder').default;
    window.router.addRoutes([
        {path: FormList.path, component: FormList},
        {path: FormBuilder.path, component: FormBuilder},
    ]);
});

export const icon = require('../assets/logo.svg');
