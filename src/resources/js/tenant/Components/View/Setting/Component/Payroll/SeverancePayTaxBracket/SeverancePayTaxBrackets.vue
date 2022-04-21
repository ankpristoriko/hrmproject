<template>
    <div>
        <app-table
            id="severance-pay-tax-brackets-table"
            :options="options"
            @action="triggerActions"
        />

        <app-severance-pay-tax-bracket-create-edit
            v-if="isModalActive"
            v-model="isModalActive"
            :selected-url="selectedUrl"
        />

        <app-confirmation-modal
            v-if="confirmationModalActive"
            icon="trash-2"
            modal-id="app-confirmation-modal"
            @confirmed="confirmed('severance-pay-tax-brackets-table')"
            @cancelled="cancelled"
        />
    </div>
</template>

<script>

import HelperMixin from "../../../../../../../common/Mixin/Global/HelperMixin";
import SeverancePayTaxBracketMixins from "../SeverancePayTaxBracket/Mixin/SeverancePayTaxBracketMixins";
import TriggerActionMixin from "../../../../../../../common/Mixin/Global/TriggerActionMixin";
import DeleteMixin from "../../../../../../../common/Mixin/Global/DeleteMixin";

export default {
    name: "SeverancePayTaxBrackets",
    mixins: [HelperMixin, SeverancePayTaxBracketMixins, TriggerActionMixin, DeleteMixin],
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
                this.selectedUrl = `${this.apiUrl.SEVERANCE_PAY_TAX_BRACKETS}/${row.id}`;
                this.isModalActive = true;
            } else {
                this.getAction(row, action, active)
            }
        },
    }
}
</script>
