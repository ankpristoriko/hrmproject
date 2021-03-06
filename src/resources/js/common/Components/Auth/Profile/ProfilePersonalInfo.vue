<template>
    <form ref="form" data-url='admin/auth/users/change-settings' v-if="!preloader">
        <app-form-group
            :disabled="!editField"
            page="page"
            :label="$t('first_name')"
            type="text"
            id="input-text-first-name"
            :placeholder="$placeholder('first_name', '')"
            v-model="userProfileInfo.first_name"
            :error-message="$errorMessage(errors, 'first_name')"
        />

        <app-form-group
            :disabled="!editField"
            page="page"
            :label="$t('last_name')"
            type="text"
            id="input-text-last-name"
            :placeholder="$placeholder('last_name')"
            v-model="userProfileInfo.last_name"
            :error-message="$errorMessage(errors, 'last_name')"
        />

        <app-form-group
            :disabled="!editField"
            page="page"
            :label="$t('email')"
            type="email"
            id="input-text-email"
            :placeholder="$placeholder('email', '')"
            v-model="userProfileInfo.email"
            :error-message="$errorMessage(errors, 'email')"
        />

        <app-form-group
            v-if="userProfileInfo.profile"
            :disabled="!editField"
            page="page"
            :label="$t('gender')"
            type="radio"
            :list="[
                {id:'male',value: $t('male')},
                {id:'female', value:  $t('female')}
            ]"
            v-model="userProfileInfo.profile.gender"
            :error-message="$errorMessage(errors, 'gender')"

        />

        <app-form-group
            v-if="userProfileInfo.profile"
            :disabled="!editField"
            page="page"
            :label="$t('marital_status')"
            type="select"
            v-model="userProfileInfo.profile.marital_status"
            :list="getMaritalStatus"
            :placeholder="$placeholder('marital_status', '')"
            :error-message="$errorMessage(errors, 'marital_status')"
        />

        <app-form-group
            :disabled="!editField"
            page="page"
            :label="$t('number_of_children')"
            type="text"
            id="input-text-number-of-children"
            :placeholder="$placeholder('number_of_children', '')"
            v-model="userProfileInfo.number_of_children"
            :error-message="$errorMessage(errors, 'number_of_children')"
        />

        <app-form-group
            page="page"
            type="search-select"
            list-value-field="value"
            :label="$t('nationality')"
            :chooseLabel="$t('nationality')"
            v-model="formData.nationality"
            :list="countries"
            :error-message="$errorMessage(errors, 'nationality')"
        />

        <app-form-group-selectable
            page="page"
            type="search-select"
            :label="$t('religion')"
            list-value-field="name"
            :chooseLabel="$t('religion')"
            v-model="formData.religion_id"
            :error-message="$errorMessage(errors, 'religion_id')"
            :fetch-url="`${TENANT_SELECTABLE_RELIGION}`"
        />

        <app-form-group-selectable
            page="page"
            type="search-select"
            :label="$t('ethnicity')"
            list-value-field="name"
            :chooseLabel="$t('ethnicity')"
            v-model="formData.ethnicity_id"
            :error-message="$errorMessage(errors, 'ethnicity_id')"
            :fetch-url="`${TENANT_SELECTABLE_ETHNICITY}`"
        />

        <app-form-group
            v-if="userProfileInfo.profile"
            :disabled="!editField"
            page="page"
            :label="$fieldTitle('contact', 'number')"
            type="tel-input"
            id="input-text-contact"
            :placeholder="userProfileInfo.profile.contact ? $placeholder('contact', 'number') : this.$t('not_added_yet')"
            v-model="userProfileInfo.profile.contact"
            :error-message="$errorMessage(errors, 'contact')"
        />

        <app-form-group
            v-if="userProfileInfo.profile"
            :disabled="!editField"
            page="page"
            :label="$t('address')"
            type="text"
            id="input-text-address"
            :placeholder="userProfileInfo.profile.address ? $placeholder('address') : this.$t('not_added_yet')"
            v-model="userProfileInfo.profile.address"
            :error-message="$errorMessage(errors, 'address')"
        />

        <app-form-group
            v-if="userProfileInfo.profile"
            :disabled="!editField"
            page="page"
            :label="$t('date_of_birth')"
            type="date"
            v-model="userProfileInfo.profile.date_of_birth"
            :placeholder="userProfileInfo.profile.date_of_birth ? $placeholder('date_of_birth') : this.$t('not_added_yet')"
            :error-message="$errorMessage(errors, 'date_of_birth')"
        />

        <div class="form-group mt-5 mb-0" v-if="editField">
            <app-submit-button @click="submitData" :title="$t('save')" :loading="loading"/>
            <button class="btn btn-secondary ml-2" @click.prevent="refreshData">{{ this.$t('cancel') }}</button>
        </div>
    </form>
    <app-pre-loader class="p-primary" v-else />
</template>

<script>
    import moment from 'moment'
    import FormHelperMixins from "../../../Mixin/Global/FormHelperMixins";
    import {addSelectInSelectArray, addChooseInSelectArray} from "../../../../common/Helper/Support/FormHelper";
    import {TENANT_SELECTABLE_RELIGION, TENANT_SELECTABLE_ETHNICITY} from "../../../../common/Config/apiUrl";
    import countries from "../../../../tenant/Components/View/Employee/Helper/countries";


    export default {
        name: "ProfilePersonalInfo",
        mixins: [FormHelperMixins],
        props: {
            id: {
                type: String
            }
        },
        data() {
            return {
                TENANT_SELECTABLE_RELIGION,
                TENANT_SELECTABLE_ETHNICITY,
                userProfileInfo: {},
                editField: false,
            }
        },
        methods: {
            submitData() {
                let profile = this.userProfileInfo;
                this.loading = true;
                profile.gender = this.userProfileInfo.profile.gender;
                profile.marital_status = this.userProfileInfo.profile.marital_status;
                profile.number_of_children = this.userProfileInfo.profile.number_of_children;
                profile.nationality = this.userProfileInfo.profile.nationality;
                profile.religion_id =  this.userProfileInfo.profile.religion_id;
                profile.ethnicity_id =  this.userProfileInfo.profile.ethnicity_id;
                profile.contact = this.userProfileInfo.profile.contact;
                profile.address = this.userProfileInfo.profile.address;
                profile.date_of_birth = this.userProfileInfo.profile.date_of_birth ? moment(this.userProfileInfo.profile.date_of_birth).format('YYYY-MM-DD') : '';
                this.save(profile);
            },
            afterSuccess(response) {
                this.loading = false;
                this.$toastr.s('', response.data.message);
                this.scrollToTop(false)
                setTimeout(() => location.reload())
            },

            cancelUser() {
                location.reload();
            },
            refreshData(){
                this.$store.dispatch('getUserInformation');
                this.preloader = true;
                this.editField = false;
            }
        },
        computed: {
            userInfo() {
                return this.$store.getters.getUserInformation
            },
            getMaritalStatus() {
                return addSelectInSelectArray([
                    {id: 'single', value: this.$t('single')},
                    {id: 'married', value: this.$t('married')},
                    {id: 'widowed', value: this.$t('widowed')},
                    {id: 'divorced', value: this.$t('divorced')},
                ], 'value', 'marital_status');
            },
            countries() {
                return addChooseInSelectArray(countries, 'value', this.$t('country'))
            }
        },
        mounted() {
            this.$store.dispatch('getUserInformation');
            this.preloader = true;

            this.$hub.$on('headerButtonClicked-' + this.id, (component) => {
                this.editField = true;
            })
        },

        watch: {
            userInfo: {
                handler: function (user) {
                    if (user) this.preloader = false
                    this.userProfileInfo = {
                        ...user,
                        profile: {
                            ...user.profile,
                            date_of_birth: user.profile && user.profile.date_of_birth ? new Date(user.profile.date_of_birth) : ''
                        }
                    };
                },
                deep: true
            }
        }

    }
</script>


