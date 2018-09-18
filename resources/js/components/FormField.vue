<template>
  <div>
    <component 
    v-for="meta in field.fields"
    :ref="meta.attribute"
    :key="meta.attribute"
    :resource-name="resourceName" 
    :resource-id="resourceId" 
    :field="meta" 
    :is="`form-${meta.component}`">

  </component>
</div>
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
          if (this.resourceId === undefined) {
            return this.value = '';
          }
          this.$children.forEach((component) => {
            component.value = this.field.value[component.field.attribute];
          });
          this.value = this.field.value || []
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
         fill(formData) {
           this.$children.forEach((component) => {
            formData.append(`${this.field.attribute}[${component.field.attribute}]`, component.value)
          });
         },


        /**
         * Update the field's internal value.
         */
         handleChange(value) {
          this.value = value
        }
      }
    }
  </script>
