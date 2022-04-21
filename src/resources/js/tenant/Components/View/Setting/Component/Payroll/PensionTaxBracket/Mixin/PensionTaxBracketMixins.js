import {PENSION_TAX_BRACKETS} from '../../../../../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('key'),
                url: PENSION_TAX_BRACKETS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('lower_gross_annual_income'),
                        type: 'text',
                        key: 'lower_gross_annual_income',
                        isVisible: true,
                    },
                    {
                        title: this.$t('upper_gross_annual_income'),
                        type: 'text',
                        key: 'upper_gross_annual_income',
                        isVisible: true,
                    },
                    {
                        title: this.$t('tax_deducted_rate'),
                        type: 'text',
                        key: 'tax_deducted_rate',
                        isVisible: true,
                    },
                    {
                        title: this.$t('currency'),
                        type: 'text',
                        key: 'currency',
                        isVisible: true,
                    },
                ],
                filters: [
                    {
                        title: this.$t('created'),
                        type: "range-picker",
                        key: "date",
                        option: ["today", "thisMonth", "last7Days", "thisYear"]
                    },
                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: (this.$have('PERMISSION_UPDATE_PENSION_TAX_BRACKET') || this.$have('PERMISSION_DELETE_PENSION_TAX_BRACKET')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-pension-tax-bracket-modal',
                        modalId: 'tax-bracket-modal',
                        url: PENSION_TAX_BRACKETS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_PENSION_TAX_BRACKET')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: PENSION_TAX_BRACKETS,
                        modifier: () => this.$have('PERMISSION_DELETE_PENSION_TAX_BRACKET')
                    },
                ],
            },
            isPensionTaxBracketAddEditModalActive: false,
            isPensionTaxBracketDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_PENSION_TAX_BRACKET') || this.$have('PERMISSION_DELETE_PENSION_TAX_BRACKET')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
