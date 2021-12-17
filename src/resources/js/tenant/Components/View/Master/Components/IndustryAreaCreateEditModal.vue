<template>
    <modal id="industry-area-modal"
           v-model="showModal"
           :title="generateModalTitle('industry_area')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form" :data-url='this.selectedUrl ? this.selectedUrl : apiUrl.INDUSTRY_AREAS'>
            <app-form-group
                :label="$t('name')"
                v-model="formData.name"
                :placeholder="$placeholder('name', '')"
                :required="true"
                :error-message="$errorMessage(errors, 'name')"
            />
            <app-form-group
                :label="$t('description')"
                v-model="formData.description"
                :placeholder="$placeholder('description', '')"
                :required="true"
                :error-message="$errorMessage(errors, 'description')"
            />
        </form>
    </modal>
</template>

<script>
import ModalMixin from "../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../common/Mixin/Global/FormHelperMixins";

export default {
    name: "IndustryAreaCreateEditModal",
    mixins: [ModalMixin, FormHelperMixins],
    methods: {
        afterSuccess({data}) {
            this.toastAndReload(data.message, 'industry-areas-table');
            this.formData = {};
            $('#industry-area-modal').modal('hide');
            this.$emit('input', false);
        }
    },
}
</script>

<style scoped>

</style>
