<script setup>
import Multiselect from "vue-multiselect";

let model = defineModel();
let props = defineProps({
    options: Array,
});
</script>
<template>
    <div>
        <Multiselect
            v-model="model"
            :clear-on-select="false"
            :close-on-select="false"
            :multiple="true"
            :options="options"
            label="label"
            track-by="id"
        ></Multiselect>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
