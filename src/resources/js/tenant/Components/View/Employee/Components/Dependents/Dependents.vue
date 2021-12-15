<template>
    <div>
        <app-overlay-loader v-if="preloader"/>
        <template v-else>
            <div class="row mb-primary" v-for="dependent in dependents">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="user"/>
                            </div>
                        </div>
                        {{ dependent.value.name }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <template v-if="dependent.value">
                        <dependent-details :value="dependent.relationship_name" identifier="relationship_name"  icon="users"/>
                        <dependent-details :value="dependent.value" identifier="bpjs_no" icon="clipboard"/>
                        <div v-if="dependent.value.city || dependent.value.country || dependent.value.address" class="d-flex">
                            <div class="mr-2">
                                <app-icon
                                    name="map-pin"
                                    class="primary-text-color"
                                    width="16"
                                    height="16"
                                />
                            </div>
                            <div>
                                <p v-if="$optional(dependent, 'value', 'address')" class="mb-0">{{ dependent.value.address }}</p>
                                <p class="mb-0">
                                    {{ dependent.value.city }}
                                    <template v-if="dependent.value.city && dependent.value.country">,</template>
                                    {{ dependent.value.country }}
                                </p>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="col-lg-3">
                    <div class="text-right mt-3 mt-lg-0">
                        <div class="btn-group btn-group-action" role="group"
                             aria-label="Default action">
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('edit')"
                                    v-if="$can('update_employee_dependents')"
                                    @click="editModal(dependent.id)">
                                <app-icon name="edit"/>
                            </button>
                            <button class="btn"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    :title="$t('delete')"
                                    v-if="$can('delete_employee_dependents')"
                                    @click="getConfirmations(dependent.id)">
                                <app-icon name="trash-2"/>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center" v-if="$can('create_employee_dependents')">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                        <div>
                            <div class="icon-box mr-2">
                                <app-icon name="user-plus"/>
                            </div>
                        </div>
                        {{ $t('dependent') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <p class="text-muted mb-0">
                        {{ $t('you_can_add_multiple_dependents') }}
                    </p>
                </div>
                <div class="col-lg-3">
                    <div class="text-right">
                        <button class="btn btn-primary" @click="addModal" >
                            {{ $t('add') }}
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <app-employee-dependent-modal
            v-if="isModalActive"
            v-model="isModalActive"
            @close="isModalActive = false"
            :selected-url="selectedUrl"
            @reload="getDependents"
            :url="url"
        />
        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="deleteModal"
            @cancelled="cancelled"
            :reload="getDependents()"
        />
    </div>
</template>

<script>
import {axiosGet, axiosDelete} from "../../../../../../common/Helper/AxiosHelper";
import DependentDetails from "./Components/DependentDetails";

export default {
    name: "Dependents",
    components: {DependentDetails},
    props: ['props'],
    data() {
        return {
            confirmationModalActive: false,
            preloader: true,
            dependents: [],
            isModalActive: false,
            selectedUrl: '',
            deletedUrl: ''
        }
    },
    mounted() {
        this.getDependents();
    },
    methods: {
        getDependents() {
            axiosGet(this.url).then(({data}) => {
                this.dependents = data;
            }).finally(() => {
                this.preloader = false;
            });
        },
        openModal() {
            this.isModalActive = true;
        },
        addModal() {
            this.selectedUrl = '';
            this.openModal();
        },
        editModal(dependentId) {
            this.selectedUrl = `${this.url}/${dependentId}`;
            this.openModal();
        },
        deleteModal() {
            axiosDelete(this.deletedUrl).then(({data}) => {
                this.$toastr.s('', data.message);
                this.deletedUrl = '';
                this.confirmationModalActive = false;
                this.$emit('reload');
            }).catch((error) => {
                if (error.response)
                    this.toastException(error.response.data)
            });
        },
        getConfirmations(dependentId) {
            this.deletedUrl = `${this.url}/${dependentId}`;
            this.confirmationModalActive = true;
        },
        cancelled() {
            this.confirmationModalActive = false;
        },
    },
    computed: {
        url() {
            return `${this.apiUrl.EMPLOYEES}/${this.props.id}/dependents`;
        }
    }
}
</script>