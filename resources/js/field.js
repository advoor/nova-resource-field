Nova.booting((Vue, router, store) => {
    Vue.component('index-nova-view-field', require('./components/IndexField'))
    Vue.component('detail-nova-view-field', require('./components/DetailField'))
    Vue.component('form-nova-view-field', require('./components/FormField'))
})
