import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'
import {createInertiaApp} from '@inertiajs/react'
import {createRoot} from 'react-dom/client'
import {resolvePageComponent} from "laravel-vite-plugin/inertia-helpers";

createInertiaApp({
    resolve: async name => resolvePageComponent(
        `./Pages/${name}.jsx`,
        import.meta.glob('./Pages/**/*.jsx')
    ),
    setup({el, App, props}) {
        createRoot(el).render(<App {...props} />)
    },
}).then(r => console.log(r))
