<template>
    <modal id="training-type-modal"
           v-model="showModal"
           :title="generateModalTitle('training_type')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form" :data-url='this.selectedUrl ? this.selectedUrl : apiUrl.TRAINING_TYPES'>
            <app-form-group
                :label="$t('name')"
                v-model="formData.name"
                :placeholder="$placeholder('name', '')"
                :required="true"
                :error-message="$errorMessage(errors, 'name')"
            />
        </form>
    </modal>
</template>

<script>
import ModalMixin from "../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../common/Mixin/Global/FormHelperMixins";

export default {
    name: "TrainingTypeCreateEditModal",
    mixins: [ModalMixin, FormHelperMixins],
    methods: {
        afterSuccess({data}) {
            this.toastAndReload(data.message, 'training-types-table');
            this.formData = {};
            $('#training-type-modal').modal('hide');
            this.$emit('input', false);
        }
    },
}
</script>

<style scoped>

</style>
