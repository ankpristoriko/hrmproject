<template>
    <modal id="course-material-category-modal"
           v-model="showModal"
           :title="generateModalTitle('course_material_category')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form" :data-url='this.selectedUrl ? this.selectedUrl : apiUrl.COURSE_MATERIAL_CATEGORIES'>
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
    name: "CourseMaterialCategoryCreateEditModal",
    mixins: [ModalMixin, FormHelperMixins],
    methods: {
        afterSuccess({data}) {
            this.toastAndReload(data.message, 'course-material-categories-table');
            this.formData = {};
            $('#course-material-category-modal').modal('hide');
            this.$emit('input', false);
        }
    },
}
</script>

<style scoped>

</style>
