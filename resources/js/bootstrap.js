// import Alpine from 'alpinejs'
// import Persist from '@alpinejs/persist'
// import Collapse from '@alpinejs/collapse'
// import Intersect from '@alpinejs/intersect'
// import Morph from '@alpinejs/morph'
// import Focus from '@alpinejs/focus'
//
// window.Alpine = Alpine
// Alpine.start()
// Alpine.plugin(Persist)
// Alpine.plugin(Collapse)
// Alpine.plugin(Intersect)
// Alpine.plugin(Morph)
// Alpine.plugin(Focus)

import Echo from "laravel-echo"
import Pusher from "pusher-js"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: 'ap2',
    forceTLS: true
});

