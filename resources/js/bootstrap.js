import Alpine from 'alpinejs'
import Persist from '@alpinejs/persist'
import Collapse from '@alpinejs/collapse'
import Intersect from '@alpinejs/intersect'
import Morph from '@alpinejs/morph'
import Focus from '@alpinejs/focus'
// import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
// Alpine.plugin(FormsAlpinePlugin)

window.Alpine = Alpine
Alpine.start()
Alpine.plugin(Persist)
Alpine.plugin(Collapse)
Alpine.plugin(Intersect)
Alpine.plugin(Morph)
Alpine.plugin(Focus)
