import {BPJS_PARAMETERS} from '../../../../../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('parameter_code'),
                url: BPJS_PARAMETERS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('parameter_code'),
                        type: 'text',
                        key: 'parameter_code',
                        isVisible: true,
                    },
                    {
                        title: this.$t('description'),
                        type: 'text',
                        key: 'description',
                        isVisible: true,
                    },
                    {
                        title: this.$t('parameter_value'),
                        type: 'text',
                        key: 'parameter_value',
                        isVisible: true,
                    },
                    {
                        title: this.$t('valid_from'),
                        type: 'text',
                        key: 'valid_from',
                        isVisible: true,
                    },
                    {
                        title: this.$t('valid_to'),
                        type: 'text',
                        key: 'valid_to',
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
                showAction: (this.$have('PERMISSION_UPDATE_BPJS_PARAMETER') || this.$have('PERMISSION_DELETE_BPJS_PARAMETER')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-bpjs-parameter-modal',
                        modalId: 'bpjs-parameter-modal',
                        url: BPJS_PARAMETERS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_BPJS_PARAMETER')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: BPJS_PARAMETERS,
                        modifier: () => this.$have('PERMISSION_DELETE_BPJS_PARAMETER')
                    },
                ],
            },
            isBpjsParameterAddEditModalActive: false,
            isBpjsParameterDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_BPJS_PARAMETER') || this.$have('PERMISSION_DELETE_BPJS_PARAMETER')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
