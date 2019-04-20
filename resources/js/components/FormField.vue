<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <select-control
                    :id="field.attribute"
                    v-model="value"
                    class="w-full form-control form-select"
                    :class="errorClasses"
                    :options="field.options"
                    :disabled="isReadonly"
            >
                <option :value="field.default.value" selected>{{ __(field.default.label) }}</option>
            </select-control>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || null

            console.log(this.field)
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
