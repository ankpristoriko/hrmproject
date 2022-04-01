import {RELIGIONS} from '../../../Config/ApiUrl'

export default {
    data() {
        return {
            options: {
                name: this.$t('name'),
                url: RELIGIONS,
                showHeader: true,
                tableShadow:false,
                tablePaddingClass:'pt-primary',
                columns: [
                    {
                        title: this.$t('name'),
                        type: 'text',
                        key: 'name',
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
                showAction: (this.$have('PERMISSION_UPDATE_RELIGION') || this.$have('PERMISSION_DELETE_RELIGION')),
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: this.$t('edit'),
                        icon: 'edit',
                        type: 'modal',
                        component: 'app-religion-modal',
                        modalId: 'religion-modal',
                        url: RELIGIONS,
                        name: 'edit',
                        modifier: () => this.$have('PERMISSION_UPDATE_RELIGION')
                    },
                    {
                        title: this.$t('delete'),
                        name: 'delete',
                        icon: 'trash-2',
                        modalClass: 'warning',
                        url: RELIGIONS,
                        modifier: () => this.$have('PERMISSION_DELETE_RELIGION')
                    },
                ],
            },
            isReligionAddEditModalActive: false,
            isReligionDeleteModalActive: false,
        }
    },

    beforeMount() {
        if (this.$have('PERMISSION_UPDATE_RELIGION') || this.$have('PERMISSION_DELETE_RELIGION')) {
            this.options.columns.push({
                title: this.$t('actions'),
                type: 'action'
            })
        }
    },
}
