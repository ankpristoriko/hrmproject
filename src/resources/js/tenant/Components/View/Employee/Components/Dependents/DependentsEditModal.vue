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
                    <app-form-group-selectable
                        type="search-select"
                        :label="$t('relationship')"
                        list-value-field="name"
                        :chooseLabel="$t('relationship')"
                        v-model="formData.relationship_id"
                        :required="true"
                        :error-message="$errorMessage(errors, 'relationship_id')"
                        :fetch-url="`${TENANT_SELECTABLE_RELATIONSHIP}`"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('place_of_birth')"
                        :placeholder="$placeholder('place_of_birth')"
                        v-model="formData.place_of_birth"
                        :error-message="$errorMessage(errors, 'place_of_birth')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('date_of_birth')"
                        :placeholder="$placeholder('date_of_birth')"
                        v-model="formData.date_of_birth"
                        :required="true"
                        :error-message="$errorMessage(errors, 'date_of_birth')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('identity_no')"
                        :placeholder="$placeholder('identity_no')"
                        v-model="formData.identity_no"
                        :required="true"
                        :error-message="$errorMessage(errors, 'identity_no')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('bpjs_no')"
                        :placeholder="$placeholder('bpjs_no')"
                        v-model="formData.bpjs_no"
                        :error-message="$errorMessage(errors, 'bpjs_no')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('occupation')"
                        :placeholder="$placeholder('occupation')"
                        v-model="formData.occupation"
                        :required="true"
                        :error-message="$errorMessage(errors, 'occupation')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group-selectable
                        type="search-select"
                        :label="$t('education_level')"
                        list-value-field="name"
                        :chooseLabel="$t('education_level')"
                        v-model="formData.education_level"
                        :required="true"
                        :error-message="$errorMessage(errors, 'education_level')"
                        :fetch-url="`${TENANT_SELECTABLE_EDUCATION}`"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('nationality')"
                        :placeholder="$placeholder('nationality')"
                        v-model="formData.nationality"
                        :required="true"
                        :error-message="$errorMessage(errors, 'nationality')"
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
                        :error-message="$errorMessage(errors, 'city')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('zip_code')"
                        :placeholder="$placeholder('zip_code')"
                        v-model="formData.zip_code"
                        :error-message="$errorMessage(errors, 'zip_code')"
                    />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <app-form-group
                        :label="$t('state')"
                        :placeholder="$placeholder('state')"
                        v-model="formData.state"
                        :error-message="$errorMessage(errors, 'state')"
                    />
                </div>
                <div class="col-md-6">
                    <app-form-group
                        type="select"
                        :label="$t('country')"
                        :chooseLabel="$t('country')"
                        v-model="formData.country"
                        :list="countries"
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
import {TENANT_SELECTABLE_RELATIONSHIP} from "../../../../../../common/Config/apiUrl";
import {TENANT_SELECTABLE_EDUCATION} from "../../../../../../common/Config/apiUrl";

export default {
    name: "EmployeeDependentEditModel",
    mixins: [FormHelperMixins, ModalMixin],
    props: {
        url: {},
    },
    data() {
        return {
            TENANT_SELECTABLE_RELATIONSHIP,
            TENANT_SELECTABLE_EDUCATION,
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