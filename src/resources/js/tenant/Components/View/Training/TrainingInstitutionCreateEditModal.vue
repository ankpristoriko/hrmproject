<template>
    <modal id="training-institution-modal"
           v-model="showModal"
           :title="generateModalTitle('training_institution')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form" :data-url='this.selectedUrl ? this.selectedUrl : apiUrl.TRAINING_INSITUTIONS'>
            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('name')"
                        v-model="formData.name"
                        :placeholder="$placeholder('name', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'name')"
                    />
                </div>

                <div class="col-md-6">
                    <app-form-group
                        :label="$t('contact_name')"
                        v-model="formData.contact_name"
                        :placeholder="$placeholder('contact_name', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'contact_name')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('phone_number')"
                        v-model="formData.phone_number"
                        :placeholder="$placeholder('phone_number', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'phone_number')"
                    />
                </div>

                <div class="col-md-6">
                    <app-form-group
                        :label="$t('email')"
                        v-model="formData.email"
                        :placeholder="$placeholder('email', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'email')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <app-form-group
                        :label="$t('address')"
                        v-model="formData.address"
                        :placeholder="$placeholder('address', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'address')"
                    />
                </div>

                <div class="col-md-6">
                    <app-form-group
                        :label="$t('country')"
                        v-model="formData.country"
                        :placeholder="$placeholder('country', '')"
                        :required="true"
                        :error-message="$errorMessage(errors, 'country')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('valid_from', '')"
                            :id="'valid_from'"
                            type="date"
                            v-model="formData.valid_from"
                            :placeholder="$placeholder('valid_from', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'valid_from')"
                        />
                </div>
                <div class="col-md-6">
                    <app-form-group
                            :label="$fieldTitle('valid_to', '')"
                            :id="'valid_to'"
                            type="date"
                            v-model="formData.valid_to"
                            :placeholder="$placeholder('valid_to', '')"
                            :required="true"
                            :error-message="$errorMessage(errors, 'valid_to')"
                        />
                </div>
            </div>
        </form>
    </modal>
</template>

<script>
import ModalMixin from "../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../common/Mixin/Global/FormHelperMixins";
import {formatDateForServer} from "../../../../common/Helper/Support/DateTimeHelper";

export default {
    name: "TrainingInstitutionCreateEditModal",
    mixins: [ModalMixin, FormHelperMixins],
    data() {
        return {
            formData: {},
            errors: {},
            preloader: false,
        }
    },
    methods: {
        afterSuccess({data}) {
            this.toastAndReload(data.message, 'training-institutions-table');

            let formData = {...this.formData};

            formData.valid_from = formatDateForServer(this.formData.valid_from);
            formData.valid_to = formatDateForServer(this.formData.valid_to);
            
            $('#training-institution-modal').modal('hide');
            this.$emit('input', false);
        }
    },
}
</script>

<style scoped>

</style>
