<template>
    <div class="content-wrapper">
        <app-page-top-section :title="$t('training_institutions')" icon="briefcase">
            <app-default-button
                v-if="$can('add_training_institutions')"
                @click="isModalActive = true"
                :title="$fieldTitle('add', 'institution', true)"/>
        </app-page-top-section>

        <app-table
            id="training-institution-table"
            :options="options"
            @action="triggerActions"
        />

        <app-training-institution-add
            v-if="isModalActive"
            v-model="isModalActive"
            :selected-url="selectedUrl"
        />

         <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="confirmed('training-institutions-table')"
            @cancelled="cancelled"
        />
    </div>
</template>

<script>

import HelperMixin from "../../../../common/Mixin/Global/HelperMixin";
import TrainingInstitutionMixin from "../../Mixins/Training/TrainingInstitutionMixin";
import TriggerActionMixin from "../../../../common/Mixin/Global/TriggerActionMixin";
import DeleteMixin from "../../../../common/Mixin/Global/DeleteMixin";

export default {
    name: "TrainingInstitutions",
    mixins: [HelperMixin, TrainingInstitutionMixin, TriggerActionMixin, DeleteMixin],
    props: {
        props: {
            default: ''
        },
        id: {
            type: String
        }
    },
    data() {
        return {
            selectedUrl: '',
            isModalActive: false,
            confirmationModalActive: false
        }
    },
    mounted() {
        this.$hub.$on('headerButtonClicked-' + this.id, (component) => {
            this.isModalActive = true;
            this.selectedUrl = '';
        })
    },
    methods: {
        triggerActions(row, action, active) {
            if (action.name === 'edit') {
                this.selectedUrl = `${this.apiUrl.TRAINING_INSTITUTIONS}/${row.id}`;
                this.isModalActive = true;
            } else {
                this.getAction(row, action, active)
            }
        },
        openDepartmentModal() {
            this.selectedUrl = '';
            this.isModalActive = true;
        }
    }
}
</script>
