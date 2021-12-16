<template>
    <modal id="educational-institution-modal"
           v-model="showModal"
           :title="generateModalTitle('educational_institution')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form" :data-url='this.selectedUrl ? this.selectedUrl : apiUrl.EDUCATIONAL_INSTITUTIONS'>
            <app-form-group
                :label="$t('name')"
                v-model="formData.name"
                :placeholder="$placeholder('name', '')"
                :required="true"
                :error-message="$errorMessage(errors, 'name')"
            />
            <app-form-group
                :label="$t('address')"
                v-model="formData.address"
                :placeholder="$placeholder('address', '')"
                :required="true"
                :error-message="$errorMessage(errors, 'address')"
            />
        </form>
    </modal>
</template>

<script>
import ModalMixin from "../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../common/Mixin/Global/FormHelperMixins";

export default {
    name: "EducationalInstitutionCreateEditModal",
    mixins: [ModalMixin, FormHelperMixins],
    methods: {
        afterSuccess({data}) {
            this.toastAndReload(data.message, 'educational-institutions-table');
            this.formData = {};
            $('#educational-institution-modal').modal('hide');
            this.$emit('input', false);
        }
    },
}
</script>

<style scoped>

</style>
