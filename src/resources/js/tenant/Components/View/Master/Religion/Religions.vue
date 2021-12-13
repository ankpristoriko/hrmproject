<template>
    <div>
        <app-table
            id="religions-table"
            :options="options"
            @action="triggerActions"
        />

        <app-religion-create-edit
            v-if="isModalActive"
            v-model="isModalActive"
            :selected-url="selectedUrl"
        />

        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="confirmed('religions-table')"
            @cancelled="cancelled"
        />
    </div>
</template>

<script>

import HelperMixin from "../../../../../common/Mixin/Global/HelperMixin";
import ReligionMixins from "../../../Mixins/Master/ReligionMixins";
import TriggerActionMixin from "../../../../../common/Mixin/Global/TriggerActionMixin";
import DeleteMixin from "../../../../../common/Mixin/Global/DeleteMixin";

export default {
    name: "Religions",
    mixins: [HelperMixin, ReligionMixins, TriggerActionMixin, DeleteMixin],
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
                this.selectedUrl = `${this.apiUrl.RELIGIONS}/${row.id}`;
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
