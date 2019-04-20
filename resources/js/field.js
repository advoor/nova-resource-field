Nova.booting((Vue, router, store) => {
    Vue.component('index-nova-resource-field', require('./components/IndexField'))
    Vue.component('detail-nova-resource-field', require('./components/DetailField'))
    Vue.component('form-nova-resource-field', require('./components/FormField'))
})
