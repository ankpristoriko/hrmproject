<template>
    <div>
        <app-table
            id="tax-brackets-table"
            :options="options"
            @action="triggerActions"
        />

        <app-tax-bracket-create-edit
            v-if="isModalActive"
            v-model="isModalActive"
            :selected-url="selectedUrl"
        />

        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="confirmed('tax-brackets-table')"
            @cancelled="cancelled"
        />
    </div>
</template>

<script>

import HelperMixin from "../../../../../../../common/Mixin/Global/HelperMixin";
import TaxBracketMixins from "../TaxBracket/Mixin/TaxBracketMixins";
import TriggerActionMixin from "../../../../../../../common/Mixin/Global/TriggerActionMixin";
import DeleteMixin from "../../../../../../../common/Mixin/Global/DeleteMixin";

export default {
    name: "TaxBrackets",
    mixins: [HelperMixin, TaxBracketMixins, TriggerActionMixin, DeleteMixin],
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
                this.selectedUrl = `${this.apiUrl.TAX_BRACKETS}/${row.id}`;
                this.isModalActive = true;
            } else {
                this.getAction(row, action, active)
            }
        },
    }
}
</script>
