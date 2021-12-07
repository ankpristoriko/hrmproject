<template>
    <modal id="employee-dependent-modal"
           size="large"
           v-model="showModal"
           :title="generateModalTitle('dependent')"
           @submit="submitData"
           :loading="loading"
           :preloader="preloader">
        <form ref="form"
              :data-url="selectedUrl ? selectedUrl : url"
              @submit.prevent="submitData">
            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('name')"
                        :placeholder="$placeholder('name')"
                        v-model="formData.name"
                        :required="true"
                        :error-message="$errorMessage(errors, 'name')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('relationship')"
                        :placeholder="$placeholder('relationship')"
                        v-model="formData.relationship"
                        :error-message="$errorMessage(errors, 'relationship')"
                    />
                </div>
            </div>

            <app-form-group
                :label="$t('address_details')"
                type="textarea"
                :placeholder="$textAreaPlaceHolder('address_details')"
                v-model="formData.details"
                :required="true"
                :error-message="$errorMessage(errors, 'address_details')"
            />

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('city')"
                        :placeholder="$placeholder('city')"
                        v-model="formData.city"
                        form-group-class="mb-md-0"
                        :error-message="$errorMessage(errors, 'city')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        type="select"
                        :label="$t('country')"
                        :chooseLabel="$t('country')"
                        v-model="formData.country"
                        :list="countries"
                        form-group-class="mb-0"
                        :error-message="$errorMessage(errors, 'country')"
                    />
                </div>
            </div>
        </form>
    </modal>
</template>
<script>

import ModalMixin from "../../../../../../common/Mixin/Global/ModalMixin";
import FormHelperMixins from "../../../../../../common/Mixin/Global/FormHelperMixins";
import {addChooseInSelectArray} from "../../../../../../common/Helper/Support/FormHelper";
import countries from "../../Helper/countries";
import {flatObjectWithKey} from "../../../../../../common/Helper/ObjectHelper";

export default {
    name: "EmployeeDependentEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            formData: {},
            errors: {},
            preloader: false,
        }
    },
    methods: {
        submitData() {
            this.loading = true;
            this.save(this.formData)
        },
        afterSuccess({data}) {
            this.loading = false;
            $('#employee-dependent-modal').modal('hide');
            this.$toastr.s('', data.message);
            this.$emit('reload')
        },
        afterSuccessFromGetEditData({data}) {
            this.preloader = false;
            this.formData = data;
            this.formData = flatObjectWithKey(this.formData, 'value');
        },
    },
    computed: {
        countries() {
            return addChooseInSelectArray(countries, 'value', this.$t('country'))
        }
    },
}
</script>